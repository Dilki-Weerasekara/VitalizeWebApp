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
                            <div class="card ">
                                <div class="card-header text-center">
                                 Mental Health Assessment
                                </div>
                                <div class="card-body">
                                  <h5 class="card-title text-center"> Welcome to Your Path to Mental Well-being </h5>
                                  <p class="card-text">This questionnaire is designed to help you reflect on your current mental health status. Your privacy is important to us. All responses are confidential. Participation in this assessment is completely voluntary. The questionnaire is straightforward and takes only a few minutes to complete.</p>
                                  <ul class="list-group">

                                    <li class="list-group-item list-group-item-primary">We collect your email address for registration purposes and your responses to provide personalized feedback. No personal data is shared without your consent.</li>
                                    <li class="list-group-item list-group-item-secondary">Your data will be used to analyze your assessment results and provide you with relevant feedback. We do not sell or share your data with third parties for marketing purposes.</li>
                                    <li class="list-group-item list-group-item-success">We use encryption and secure servers to protect your data and maintain confidentiality</li>
                                    <li class="list-group-item list-group-item-primary">You have the right to access, correct, or request deletion of your data at any time.</li>
                                    <li class="list-group-item list-group-item-warning">By proceeding with this assessment, you consent to the collection and use of your data as outlined in this privacy policy.</li>
                                    <li class="list-group-item list-group-item-primary">You can withdraw your consent at any time by contacting us.</li>
                                    <li class="list-group-item list-group-item-danger font-weight-bold ">Disclaimer: The information provided through this assessment is for educational purposes only and is not intended to serve as a substitute for a professional medical assessment, diagnosis, or treatment. Please consult with your physician or another qualified health provider with any questions regarding your mental health.</li>
                                    <li class="list-group-item list-group-item-dark font-weight-bold">Privacy Notice: We are committed to protecting your privacy and confidentiality. Your responses will be kept confidential and will only be used to provide you with personalized feedback. We do not share your personal information with third parties without your explicit consent, except as required by law.</li>
                                  </ul>
                                  <br>

                                  {{-- check box --}}
                                  <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="check">
                                    <label class="form-check-label" for="check">
                                        I have read and agree to the Privacy Policy and Terms of Use.
                                    </label>
                                  </div>
                                  <br>
                                  {{-- start button --}}
                                <a href="{{ route('view_google_forum') }}" id="startButton" class="btn btn-primary d-flex justify-content-center disabled">Start the Assessment Now</a>

                                <br>
                                {{-- scan the QR code --}}
                                <a href="{{ route('access_QR') }}" id="qrCodeButton" class="btn btn-success d-flex justify-content-center disabled">Scan QR Code</a>
                                <br>
                                {{-- footer --}}
                                <div class="card-footer text-muted text-end">
                                  contact us : hello@vitalize.com
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

{{-- check the state of the chcek box --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var checkBox = document.getElementById('check');
        var startButton = document.getElementById('startButton');
        var qrCodeButton = document.getElementById('qrCodeButton');

        // Function to enable or disable buttons
        function toggleButtonState() {
            if (checkBox.checked) {
                startButton.classList.remove('disabled');
                qrCodeButton.classList.remove('disabled');
            } else {
                startButton.classList.add('disabled');
                qrCodeButton.classList.add('disabled');
            }
        }

        // Event listener for checkbox changes
        checkBox.addEventListener('change', toggleButtonState);

        // Initial check
        toggleButtonState();
    });
</script>




