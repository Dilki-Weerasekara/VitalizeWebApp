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

    {{-- main css stylesheet --}}
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    {{-- Link boostrap css --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

     <!-- Custom toastr styling to override Bootstrap -->
     <style>

        .toast {
            z-index: 9999 !important; /* Adjust z-index as needed */
        }

        /* Increase specificity for toastr container */
        body .toast-container .toast {
            /* Custom toastr styles here, use !important if necessary */
            opacity: 1 !important;
            display: block !important; /* May need to adjust display property */
        }

        /* Specific toastr classes, like toast-success, toast-error, etc. */
        .toast-success {
            background-color: green !important;
            color: white !important;
        }

        .toast-info{
            background-color: black !important;
            color: white !important;
        }

        .toast-warning{
            background-color: red !important;
            color: white !important;
        }



    </style>

    {{-- Link Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Neuton:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Acme&family=Courgette&family=Lobster&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IM+Fell+English+SC&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Sometype+Mono&display=swap" rel="stylesheet">

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


    <script>
        // create post alert
        window.addEventListener('alert-create-post', event => {
            toastr[event.detail.type="info"](event.detail.message="Your post will be published shortly.",
                event.detail.title ?? ''), toastr.options = {
                "closeButton": true,
                "progressBar": true,
            }
        });

        //Account information update alert
        window.addEventListener('alert-update-acc', event => {
            toastr[event.detail.type="success"](event.detail.message= " Account Informaiton Updated successfully.",
                event.detail.title ?? ''), toastr.options = {
                "closeButton": true,
                "progressBar": true,

            }
        });

        //Password Update Incorrect alert
        window.addEventListener('alert-pw-update-incorrect', event => {
            toastr[event.detail.type="warning"](event.detail.message= "Existing Password is Incorrect",
                event.detail.title ?? ''), toastr.options = {
                "closeButton": true,
                "progressBar": true,

            }
        });

         //Password Update alert
         window.addEventListener('alert-pw-update', event => {
            toastr[event.detail.type="success"](event.detail.message= "Your Password has been updated",
                event.detail.title ?? ''), toastr.options = {
                "closeButton": true,
                "progressBar": true,

            }
        });

        //left the group
        window.addEventListener('alert-group-left', event => {
            toastr[event.detail.type="info"](event.detail.message=  "You left the Group",
                event.detail.title ?? ''), toastr.options = {
                "closeButton": true,
                "progressBar": true,

            }
        });

         //join the group
         window.addEventListener('alert-group-join', event => {
            toastr[event.detail.type="success"](event.detail.message=  "You Join the Group",
                event.detail.title ?? ''), toastr.options = {
                "closeButton": true,
                "progressBar": true,

            }
        });


         //save the post
         window.addEventListener('alert-saved-post', event => {
            toastr[event.detail.type="success"](event.detail.message=  "Post Saved Successfully",
                event.detail.title ?? ''), toastr.options = {
                "closeButton": true,
                "progressBar": true,

            }
        });


         //friend request acceptance information
         window.addEventListener('alert-friend-accept', event => {
            toastr[event.detail.type="success"](event.detail.message=  "Friend request accepted ",
                event.detail.title ?? ''), toastr.options = {
                "closeButton": true,
                "progressBar": true,

            }
        });


         //friend request rejected
         window.addEventListener('alert-friend-reject', event => {
            toastr[event.detail.type="warning"](event.detail.message=  "Friend request Rejected",
                event.detail.title ?? ''), toastr.options = {
                "closeButton": true,
                "progressBar": true,

            }
        });

          //friend request sent
          window.addEventListener('alert-friend-sent', event => {
            toastr[event.detail.type="success"](event.detail.message=  "You sent a friend Request",
                event.detail.title ?? ''), toastr.options = {
                "closeButton": true,
                "progressBar": true,

            }
        });

          //friend request sent cansel
          window.addEventListener('alert-friend-request-sent-cansel', event => {
            toastr[event.detail.type="warning"](event.detail.message=  "You cansel the friend Request",
                event.detail.title ?? ''), toastr.options = {
                "closeButton": true,
                "progressBar": true,

            }
        });

         //publish the comment
         window.addEventListener('alert-publish-comment', event => {
            toastr[event.detail.type="info"](event.detail.message=  "Your comment will be published shortly.",
                event.detail.title ?? ''), toastr.options = {
                "closeButton": true,
                "progressBar": true,

            }
        });


    </script>

</body>

</html>
