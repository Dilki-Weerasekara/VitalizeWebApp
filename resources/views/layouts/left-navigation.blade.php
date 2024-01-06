<nav class="navigation scroll-bar">
    <?php
    $icons = new \Feather\IconManager();
    ?>
    <div class="container ps-0 pe-0">
        <div class="nav-content">
            <div class="pt-3 pb-1 mt-2 mb-2 bg-white nav-wrap bg-transparent-card rounded-xxl shadow-xss">
                <div class="nav-caption fw-600 font-xssss text-grey-500"><span>New </span>Feeds</div>
                <ul class="mb-1 top-content">
                    <li class="logo d-none d-xl-block d-lg-block"></li>
                    <li><a href="{{ config('app.url') }}" class="nav-content-bttn open-font"><i
                                class=" btn-round-md bg-blue-gradiant me-3"
                                style="margin-top: -10px">{!! $icons->getIcon('tv') !!}</i><span>Dashboard</span></a></li>

                    <li><a href="{{ route('groups') }}" class="nav-content-bttn open-font"><i
                                class=" btn-round-md bg-mini-gradiant me-3"
                                style="margin-top: -10px">{!! $icons->getIcon('zap') !!}</i><span>Discussion Forums</span></a>
                    </li>

                    <li><a href="{{ route('nature') }}" class="nav-content-bttn open-font"><i
                                class=" btn-round-md bg-blue-gradiant me-3"
                                style="margin-top: -10px">{!! $icons->getIcon('sun') !!}</i><span>Explore Nature</span></a></li>

                     <li><a href="{{ route('music') }}" class="nav-content-bttn open-font"><i
                                class=" btn-round-md bg-mini-gradiant me-3"
                                style="margin-top: -10px">{!! $icons->getIcon('music') !!}</i><span>Music Relaxation </span></a>
                    </li>

                    <li><a href="{{ route('self_help') }}" class="nav-content-bttn open-font"><i
                        class=" btn-round-md bg-blue-gradiant me-3"
                        style="margin-top: -10px">{!! $icons->getIcon('heart') !!}</i><span>Self-Help Programs</span></a>
                    </li>

                    <li><a href="{{ route('Inspirational_content') }}" class="nav-content-bttn open-font"><i
                        class=" btn-round-md bg-mini-gradiant me-3"
                        style="margin-top: -10px">{!! $icons->getIcon('trending-up') !!}</i><span>Motivational</span></a>
                    </li>

                    <li><a href="{{ route('assessment') }}" class="nav-content-bttn open-font"><i
                        class=" btn-round-md bg-blue-gradiant me-3"
                        style="margin-top: -10px">{!! $icons->getIcon('user-check') !!}</i><span>Assessment Tools</span></a>
                    </li>

                </ul>
            </div>


            <div class="pt-3 pb-1 bg-white nav-wrap bg-transparent-card rounded-xxl shadow-xss">
                <div class="nav-caption fw-600 font-xssss text-grey-500"><span></span> Account</div>
                <ul class="mb-1">
                    <li class="logo d-none d-xl-block d-lg-block"></li>
                    {{-- settings facility --}}
                    <li><a href="{{ route('settings') }}" class="h-auto pt-2 pb-2 nav-content-bttn open-font"><i
                                class="font-sm  me-3 text-grey-500"
                                style="margin-top: -10px">{!! $icons->getIcon('settings') !!}</i><span>User Settings</span></a></li>

                    {{-- reminder facility --}}
                    <li><a href="{{ route('reminder') }}" class="h-auto pt-2 pb-2 nav-content-bttn open-font"><i
                                    class="font-sm  me-3 text-grey-500"
                                    style="margin-top: -10px">{!! $icons->getIcon('clock') !!}</i><span>Set Reminder</span></a></li>

                    {{-- chat facility --}}
                    <li><a href="{{ url("chat") }}" class="h-auto pt-2 pb-2 nav-content-bttn open-font"><i
                                class="font-sm -square me-3 text-grey-500"
                                style="margin-top: -10px">{!! $icons->getIcon('message-circle') !!}</i><span>Chat</span></a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>
