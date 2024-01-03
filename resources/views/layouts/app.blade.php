<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<?php
$icons = new \Feather\IconManager();
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> {{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href=" {{ asset('css/themify-icons.css') }}">
    <link rel="stylesheet" href=" {{ asset('css/feather.css') }}">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href=" {{ asset('css/style.css') }}">
    <link rel="stylesheet" href=" {{ asset('css/emoji.css') }}">

    <link rel="stylesheet" href=" {{ asset('css/lightbox.css') }}">
    {{-- video player css file --}}
    <link rel="stylesheet" href="{{ asset('css/video-player.css') }}">

    {{-- toastr is a Javascript library for non-blocking notifications. jQuery is required.  --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    {{-- emoji Stylesheet --}}
    <link href="https://emoji-css.afeld.me/emoji.css" rel="stylesheet">

    @livewireStyles

</head>

<body class="color-theme-blue mont-font">

    <div class="preloader"></div>

    <div class="main-wrapper">

        <!-- navigation top-->
        @include('layouts.navigation')
        <!-- navigation top -->

        <!-- navigation left -->
        @include('layouts.left-navigation')
        <!-- navigation left -->

        <!-- main content -->
        <main>
            @yield('content')
        </main>



        <!-- right chat -->
       

    </div>


    {{-- This is the section where story display as multiple stories using carousal , here only one story per person and show all users stories  with comment feature --}}

    @foreach (App\Models\Story::where('created_at', '>=', now()->subDay())->latest()->get()->unique('user_id') as $story)
        <div class="modal bottom side fade" id="{{ $story->user->uuid }}" tabindex="-1" role="dialog"
            style=" overflow-y: auto;">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="bg-transparent border-0 modal-content">
                    <button type="button" class="mt-0 close position-absolute top--30 right--10" data-dismiss="modal"
                        aria-label="Close"><i class=" text-grey-900 font-xssss">X</i></button>
                    <div class="p-0 modal-body">
                        <div class="overflow-hidden border-0 card w-100 rounded-3 bg-gradiant-bottom bg-gradiant-top">
                            <div class="owl-carousel owl-theme dot-style3 story-slider owl-dot-nav nav-none">
                                @foreach (json_decode($story->story) as $story)
                                    <div class="item"><img src="{{ asset('storage') . '/' . $story }}"
                                            alt="image">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="bottom-0 p-3 mt-3 mb-0 form-group position-absolute z-index-1 w-100">
                            <input type="text"
                                class="p-3 text-white bg-transparent style2-input w-100 border-light-md pe-5 font-xssss fw-500"
                                value="Write Comments">
                            <span class="text-white font-md position-absolute"
                                style="bottom: 35px;right:30px;"><i>{!! $icons->getIcon('send') !!}</i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


    <script src="{{ asset('js/plugin.js') }}"></script>

    <script src="{{ asset('js/lightbox.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>

    {{-- video player --}}
    <script src="{{ asset('js/video-player.js') }}"></script>

    {{-- toastr is a Javascript library for non-blocking notifications. jQuery is required.  --}}
     <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    @livewireScripts

     {{-- <script>
        window.addEventListener('alert', event => {
        // console.log('Event type:', event.detail.type); // Add this line for debugging
        toastr[event.detail.type="info"](event.detail.message="Your Post will be Published Shortly", event.detail.title ?? ''), toastr.options = {
            "closeButton": true,
            "progressBar": true,
            }
        });

    </script> --}}

    @if (session('alert'))
        <div class="alert alert-{{ session('alert.type') }} alert-dismissible fade show" role="alert">
            {{ session('alert.message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif


    <script>
        window.onscroll = function(x) {
            if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
                window.livewire.emit("load-more")
            }
        }
    </script>
</body>

</html>
