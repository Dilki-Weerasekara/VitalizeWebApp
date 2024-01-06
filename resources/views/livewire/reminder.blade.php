<style>
    .btn-info.text-light:hover,
    .btn-info.text-light:focus {
        background: #000;
    }

    .fa.fa-alarm-clock:before {
        position: absolute;
        width: 1.25em;
        top: -0.9em;
        left: 0;
    }

    .modal-backdrop.show {
      z-index: 1040;
    }

    .modal {
      z-index: 1050;
    }


    #alarm-list:empty:before {
        content: 'No Reminder set.';
        text-align: center;
        color: rgb(214, 214, 214);
    }

    </style>


    <div class="main-content right-chat-active">
        <?php
        $icons = new \Feather\IconManager();
        ?>
        <div class="middle-sidebar-bottom">
            <div class="middle-sidebar-left">
                <!-- loader wrapper -->
                <div class="p-3 preloader-wrap">
                    <div class="box shimmer">
                        <div class="lines">
                            <div class="line s_shimmer"></div>
                            <div class="line s_shimmer"></div>
                            <div class="line s_shimmer"></div>
                            <div class="line s_shimmer"></div>
                        </div>
                    </div>
                    <div class="mb-3 box shimmer">
                        <div class="lines">
                            <div class="line s_shimmer"></div>
                            <div class="line s_shimmer"></div>
                            <div class="line s_shimmer"></div>
                            <div class="line s_shimmer"></div>
                        </div>
                    </div>
                    <div class="box shimmer">
                        <div class="lines">
                            <div class="line s_shimmer"></div>
                            <div class="line s_shimmer"></div>
                            <div class="line s_shimmer"></div>
                            <div class="line s_shimmer"></div>
                        </div>
                    </div>
                </div>
                <!-- loader wrapper -->
                <div class="row feed-body">
                    <div class="col-12">
                        <div class="p-4 mb-3 border-0 card w-100 shadow-xss rounded-xxl">
                            <div class="p-0 card-body">
                              {{-- set reminder --}}


                              <div class="container py-5" id="page-container">
                                <div class="d-flex justify-content-center align-items-center flex-column my-3">
                                    <h1 class="fw-bolder" id="current_time">00:00:00 --</h1>
                                    <h4 class="fw-bold" id="current_date">--- -- ----</h4>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 offset-md-3">
                                        <div class="card shadow">
                                            <div class="card-body">
                                                <h5 class="card-title">Set Reminder</h5>
                                                <form id="reminderForm">
                                                    <div class="mb-3">
                                                        <label for="alarmTitleInput" class="form-label">Alarm Title</label>
                                                        <input type="text" id="alarmTitleInput" class="form-control" placeholder="Alarm Title">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="alarmTimeInput" class="form-label">Time</label>
                                                        <input type="time" id="alarmTimeInput" class="form-control">
                                                    </div>
                                                    <button type="button" class="btn btn-info" onclick="setAlarmFromForm()">Set Reminder</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Reminder List -->
                                <div class="container mt-4">
                                    <div class="col-md-12">
                                        <div class="card shadow">
                                            <div class="card-header bg-dark bg-gradient text-light">
                                                <h5 class="card-title" style="color:aliceblue">Reminder List</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="list-group" id="alarm-list">
                                                    <!-- Reminder items will be added here dynamically -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>




                            </div>

                         </div>
                    </div>
                </div>

            </div>
        </div>
    </div>



    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script>
        var alarmSoundUrl = "{{ asset('sounds/clock-alarm.wav') }}";
    </script>



<script>
    var clock;
    var timer;
    var datetime;
    var alarm_audio = new Audio(alarmSoundUrl);
    var months = ['', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    var seq = window.localStorage.getItem("seq");
    var timer_item = window.localStorage.getItem("timer");
    var alarm_item = window.localStorage.getItem("alarm");

    if (seq === null) {
        window.localStorage.setItem("seq", 1);
        seq = window.localStorage.getItem("seq");
    }
    if (alarm_item === null) {
        window.localStorage.setItem("alarm", JSON.stringify({}));
        alarm_item = window.localStorage.getItem("alarm");
    }

    seq = parseInt(seq);
    timer_item = JSON.parse(timer_item || '{}');
    alarm_item = JSON.parse(alarm_item || '{}');

    function setAlarmFromForm() {
        var title = document.getElementById('alarmTitleInput').value.trim();
        var timeValue = document.getElementById('alarmTimeInput').value;
        var [hour, minute] = timeValue.split(':').map(num => parseInt(num, 10));

        if (!title) {
            alert("Please enter reminder title.");
            return;
        }

        setAlarm(hour, minute, title);
    }

    function setAlarm(hour, minute, title) {
        var now = new Date();
        var alarmTime = new Date(now.getFullYear(), now.getMonth(), now.getDate(), hour, minute, 0, 0);

        // If the alarm time is in the past, set it for the next day
        if (alarmTime < now) {
            alarmTime.setDate(alarmTime.getDate() + 1);
        }

        var alarmId = 'alarm_' + alarmTime.getTime();
        // Store the alarm details including the title
        alarm_item[alarmId] = {
            id: alarmId,
            time: alarmTime.toString(),
            title: title,
            triggered: false
        };
        // Save the updated alarms to localStorage
        localStorage.setItem('alarm', JSON.stringify(alarm_item));
        // Update the alarm list in the UI
        updateAlarmList(hour, minute, title, alarmId);
        checkAlarms();
    }


    function checkAlarms() {
        var now = new Date();
        now.setSeconds(0, 0); // Ignore seconds for comparison

        for (var id in alarm_item) {
            var alarm = new Date(alarm_item[id].time);

            // Check if the current time matches the alarm time and the alarm has not been triggered
            if (now.getHours() === alarm.getHours() && now.getMinutes() === alarm.getMinutes() && !alarm_item[id].triggered) {
                // Play the alarm sound
                alarm_audio.play().catch(e => console.error("Error playing sound:", e));

                // Mark the alarm as triggered
                alarm_item[id].triggered = true;

                // Update the alarm in localStorage
                localStorage.setItem('alarm', JSON.stringify(alarm_item));

                // Show an alert or modal
                showAlertModal(alarm_item[id].title);
            }
        }
    }

    setInterval(checkAlarms, 1000);

    function showAlertModal(message) {
        // Replace this with your modal logic if needed
        alert(message);
    }


    $(document).ready(function() {
        // Check if the browser supports notifications
        if (!("Notification" in window)) {
            alert("This browser does not support desktop notification");
        }

        // Request permission on page load
        if (Notification.permission !== "denied") {
            Notification.requestPermission();
        }
        current_datetime();
    });

    function updateAlarmList(hour, minute, title, id) {
        var meridiem = hour >= 12 ? 'PM' : 'AM';
        hour = hour % 12 || 12;
        minute = minute.toString().padStart(2, '0');
        var displayTime = hour + ':' + minute + ' ' + meridiem;

        // Create the list item HTML with the title and time
        var listItem = $(
            '<div class="list-group-item list-group-item-action">' +
            '<strong>' + title + '</strong>' + // Display the title in bold
            ' - ' + displayTime + // Display the time
            ' <button class="btn btn-sm btn-danger delete-alarm" onclick="removeAlarm(\'' + id + '\')">Delete</button>' +
            '</div>'
        );

        listItem.attr('data-id', id);
        $('#alarm-list').append(listItem);
    }


    function removeAlarm(id) {
        // Remove the alarm from the list and local storage
        $('[data-id="' + id + '"]').remove();
        delete alarm_item[id];
        window.localStorage.setItem('alarm', JSON.stringify(alarm_item));
    }



    window.current_datetime = function() {
        clock = setInterval(function() {
            datetime = new Date();
            var hour = datetime.getHours()
            var min = datetime.getMinutes()
            var sec = datetime.getSeconds()
            var month = datetime.getMonth()
            var day = datetime.getDate()
            var year = datetime.getFullYear()
            hr = String(hour).padStart(2, '0');
            min = String(min).padStart(2, '0');
            sec = String(sec).padStart(2, '0');
            day = String(day).padStart(2, '0');
            Object.keys(alarm_item).map(function(k) {
                var _ai = alarm_item[k]
                if (String(hour + ":" + min + ":" + sec) == String(_ai.time + ":00")) {
                    $('.alarm-text[data-id="' + _ai.id + '"]').addClass("blinks")
                    alarm_audio.loop = true;
                    alarm_audio.currentTime = 0;
                    alarm_audio.play()
                    $('#stop_alarm').removeClass('d-none')
                }
            })
            var hr = Math.abs(hour) > 12 ? Math.abs(hour) - 12 : hour;
            var meridiem = hour >= 12 ? "PM" : "AM";
            hr = String(hr).padStart(2, '0');
            var cur_time = hr + ":" + min + ":" + sec + " " + meridiem
            var cur_date = months[month] + " " + day + ", " + year
            $("#current_time").text(cur_time)
            $("#current_date").text(cur_date)
        }, 300)
    }

    window.uniModal = function($title = "", $content = {}, $data = []) {
        var uni = $('#uniModal')
        uni.find('.modal-title').html($title)
        uni.find(".modal-body").html("")
        uni.find(".modal-body").append($content)
        uni.modal("show")

        // Alarm Form Submit
        $content.find('form#alarm-form').submit(function(e) {
            e.preventDefault()
            e.stopImmediatePropagation();
            if ($(this)[0].checkValidity() === false) {
                $(this)[0].reportValidity()
                return false;
            }
            var _hr = $(this).find('[name="hour"]').val();
            var _min = $(this).find('[name="minutes"]').val();
            var _mer = $(this).find('[name="meridein"]').val();
            _hr = String(_hr).padStart(2, '0')
            _min = String(_min).padStart(2, '0')
            var alarm = _hr + ":" + _min + " " + _mer;
            if (_mer == "PM" && _hr != 12)
                _hr = Math.abs(_hr) + 12
            if (_mer == "AM" && _hr == 12)
                _hr = 0;
            _hr = String(_hr).padStart(2, '0')
            _min = String(_min).padStart(2, '0')
            __time = _hr + ":" + _min
            if ($(this).find('[name="id"]').val() > 0) {
                var _id = $(this).find('[name="hour"]').val();
            } else {
                seq++;
                localStorage.setItem('seq', seq)
                var _id = seq;
            }
            alarm_item[_id] = { id: _id, time: __time, alarm: alarm }
            localStorage.setItem('alarm', JSON.stringify(alarm_item))
            alert("Alarm Successfully Saved")
            new_alarm_list(_id)
            $('.modal').modal("hide")
        })

        // Timer Form Submit
        $content.find('form#timer-form').submit(function(e) {
            e.preventDefault()
            e.stopImmediatePropagation();
            if ($(this)[0].checkValidity() === false) {
                $(this)[0].reportValidity()
                return false;
            }
            timer_item = { timer: String($(this).find('[name="minutes"]').val()).padStart(2, '0') + ":" + String($(this).find('[name="seconds"]').val()).padStart(2, '0'), start: false }
            localStorage.setItem('timer', JSON.stringify(timer_item))
            alert("Timer Successfully set")
            $('.modal').modal('hide')
            reset_timer()
        })
    }

    </script>
