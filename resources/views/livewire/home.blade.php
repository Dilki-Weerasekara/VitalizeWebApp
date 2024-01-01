<div class="main-content right-chat-active">

    <?php
    $icons = new \Feather\IconManager();
    ?>

    <div class="middle-sidebar-bottom">
        <div class="middle-sidebar-left">
            <!-- loader wrapper -->
            <div class="preloader-wrap p-3">
                <div class="box shimmer">
                    <div class="lines">
                        <div class="line s_shimmer"></div>
                        <div class="line s_shimmer"></div>
                        <div class="line s_shimmer"></div>
                        <div class="line s_shimmer"></div>
                    </div>
                </div>
                <div class="box shimmer mb-3">
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
                <div class="col-xl-8 col-xxl-9 col-lg-8">


                    @livewire('components.stories')
                    {{-- End the Story Section --}}
                    @livewire('components.create-post')
                    {{-- End the section of whats on your mind --}}

                    {{-- plan to run all the post through the loop --}}
                    @forelse ($posts as $post)

                         {{-- start personal post --}}
                        <div class="card w-100 shadow-xss rounded-xxl border-0 p-4 mb-3">
                            <div class="card-body p-0 d-flex">
                                <figure class="avatar me-3"><img src="{{ $post->user->profile ? asset('storage') . '/' . $post->user->profile : 'images/user-7.png' }}" alt="image" class="shadow-sm rounded-circle w45"></figure>
                                <h4 class="fw-700 text-grey-900 font-xssss mt-1">{{ $post->user->username }} <span class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">{{ $post->created_at->diffForHumans() }}</span></h4>
                                <a href="#" class="ms-auto" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti-more-alt text-grey-900 btn-round-md bg-greylight font-xss"></i></a>
                                <div class="dropdown-menu dropdown-menu-end p-4 rounded-xxl border-0 shadow-lg" aria-labelledby="dropdownMenu2">
                                    <div class="card-body p-0 d-flex" style="cursor: pointer"
                                    wire:click="save({{ $post->id }})">
                                        <i class=" text-grey-500 me-3 font-lg" style="margin-top: -10px">{!! $icons->getIcon('bookmark') !!}</i>
                                        <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4">Save Link <span class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Add this to your saved items</span></h4>
                                    </div>
                                    <div class="card-body p-0 d-flex mt-2">
                                        <i class=" text-grey-500 me-3 font-lg" style="margin-top: -10px">{!! $icons->getIcon('alert-octagon') !!}</i>
                                        <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4">Hide all from Group <span class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Save to your saved items</span></h4>
                                    </div>
                                    <div class="card-body p-0 d-flex mt-2">
                                        <i class=" text-grey-500 me-3 font-lg" style="margin-top: -10px">{!! $icons->getIcon('lock') !!}</i>
                                        <h4 class="fw-600 mb-0 text-grey-900 font-xssss mt-0 me-4">Unfollow Group <span class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Save to your saved items</span></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0 me-lg-5">
                                <a
                                    href="{{ route('single-post', ['useruuid' => $post->user->uuid, 'postuuid' => $post->uuid]) }}">
                                    <p class="fw-500 text-grey-500 lh-26 font-xssss w-100">{{ $post->content }}</p>

                                    {{-- view the wallpost as singlePost in aother page --}}
                                </a>
                            </div>
                            <div class="card-body d-block p-0">
                                <div class="row ps-2 pe-2">

                                    {{-- first select the post media according to the post id --}}
                                    @php
                                    $post_media = App\Models\PostMedia::where('post_id', $post->id)->first();

                                    @endphp

                                    {{-- only the file type image do this step --}}
                                    @if ( $post_media && $post_media->file_type == "image")

                                                {{-- using json_decode method to convert json encode images to normal images --}}
                                                @php
                                                    $medias = json_decode($post_media->file);
                                                @endphp

                                                {{-- run the loop to retrive all the post media for the specific post id --}}
                                                @foreach( $medias as $media )
                                                    @if ($loop->index > 2)
                                                    @continue
                                                    @endif

                                                        {{-- post media count is 1 display full size image on the screen --}}
                                                            <div class="p-1 {{ count($medias)==1 ? 'col-12' : 'col-xs-4 col-sm-4' }}"><a href="{{ asset('storage').'/'.$media }}" data-lightbox="roadtrip" class="{{ $loop->index == 2 ? 'position-relative d-block': "" }}"><img src="{{ asset('storage').'/'.$media }}" class="rounded-3 w-100" alt="image">

                                                             {{-- add count variable on images when more images has to display --}}

                                                            @if ($loop->index == 2 )
                                                            <span class="img-count font-sm text-white ls-3 fw-600"><b>+{{ count($medias)-3}}</b></span>
                                                            @endif

                                                            </a></div>

                                                @endforeach

                                        @elseif ($post_media && $post_media->file_type == 'video')
                                            <video id="my-video" class="video-js" controls preload="auto" data-setup="{}"
                                                width="100%" height="100%">
                                                <source src="{{ asset('storage') . '/' . $post_media->file }}"
                                                    type="video/mp4" />
                                                <p class="vjs-no-js">
                                                    {{-- To view this video please enable JavaScript, and consider upgrading to a
                                                    web browser that --}}
                                                    <a href="https://videojs.com/html5-video-support/"
                                                        target="_blank">supports HTML5 video</a>
                                                </p>
                                            </video>
                                    @endif

                                </div>
                            </div>


                            <div class="card-body d-flex p-0 mt-3">
                                {{-- <a href="#" wire:click.prevent="like({{ $post->id }})"
                                class="emoji-bttn d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss me-2"><i class="text-white bg-primary-gradiant me-1 btn-round-sm font-xss" style="margin-top: -10px">{!! $icons->getIcon('thumbs-up') !!}</i> {{ $post->likes ?? 0 }} Like</a> --}}

                                @php
                                $like = App\Models\Like::where(['post_id' => $post->id, 'user_id' => auth()->id()])->exists();
                                @endphp
                                @if ($like)
                                <a href="#" wire:click.prevent="dislike({{ $post->id }})"
                                    class=" d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss me-2"><i
                                        class="text-info me-1 btn-round-xs font-xss"
                                        style="margin-top: -10px">{!! $icons->getIcon('thumbs-up', ['fill' => 'blue']) !!}</i>{{ $post->likes ?? 0 }}
                                    Like</a>
                                 @else
                                <a href="#" wire:click.prevent="like({{ $post->id }})"
                                    class=" d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss me-2"><i
                                        class="text-info  me-1  btn-round-xs font-xss"
                                        style="margin-top: -10px">{!! $icons->getIcon('thumbs-up') !!}</i>{{ $post->likes ?? 0 }}
                                    Like</a>
                                @endif


                                {{-- Comment Section --}}
                                <a href="#" class="d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss"><i class="text-dark text-grey-900 btn-round-md font-lg" style="margin-top: -10px">{!! $icons->getIcon('message-circle') !!}</i><span class="d-none-xss"> {{ $post->comments }} Comment</span></a>
                                {{-- Share section --}}
                                <a href="#" id="dropdownMenu21" data-bs-toggle="dropdown" aria-expanded="false" class="ms-auto d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss"><i class=" text-grey-900 text-dark btn-round-md font-lg" style="margin-top: -10px">{!! $icons->getIcon('share-2') !!}</i><span class="d-none-xs">Share</span></a>
                                <div class="dropdown-menu dropdown-menu-end p-4 rounded-xxl border-0 shadow-lg" aria-labelledby="dropdownMenu21">
                                    <h4 class="fw-700 font-xss text-grey-900 d-flex align-items-center">Share <i class="ms-auto font-xssss btn-round-xs bg-greylight text-grey-900 me-2" style="margin-top: -10px">{!! $icons->getIcon('x-square') !!}</i></h4>
                                    <div class="card-body p-0 d-flex">
                                        <ul class="d-flex align-items-center justify-content-between mt-2">
                                            <li class="me-1"><a href="#" class="btn-round-lg bg-facebook"><i class="font-xs ti-facebook text-white"></i></a></li>
                                            <li class="me-1"><a href="#" class="btn-round-lg bg-twiiter"><i class="font-xs ti-twitter-alt text-white"></i></a></li>
                                            <li class="me-1"><a href="#" class="btn-round-lg bg-linkedin"><i class="font-xs ti-linkedin text-white"></i></a></li>
                                            <li class="me-1"><a href="#" class="btn-round-lg bg-instagram"><i class="font-xs ti-instagram text-white"></i></a></li>
                                            <li><a href="#" class="btn-round-lg bg-pinterest"><i class="font-xs ti-pinterest text-white"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="card-body p-0 d-flex">
                                        <ul class="d-flex align-items-center justify-content-between mt-2">
                                            <li class="me-1"><a href="#" class="btn-round-lg bg-tumblr"><i class="font-xs ti-tumblr text-white"></i></a></li>
                                            <li class="me-1"><a href="#" class="btn-round-lg bg-youtube"><i class="font-xs ti-youtube text-white"></i></a></li>
                                            <li class="me-1"><a href="#" class="btn-round-lg bg-flicker"><i class="font-xs ti-flickr text-white"></i></a></li>
                                            <li class="me-1"><a href="#" class="btn-round-lg bg-black"><i class="font-xs ti-vimeo-alt text-white"></i></a></li>
                                            <li class="me-1"><a href="#" class="btn-round-lg bg-whatsup"><i class="font-xs text-white" style="margin-top: -10px">{!! $icons->getIcon('phone') !!}</i></a></li>
                                        </ul>
                                    </div>
                                    <h4 class="fw-700 font-xssss mt-4 text-grey-500 d-flex align-items-center mb-3">Copy Link</h4>
                                    <i class="position-absolute right-35 mt-2 font-xs text-grey-500" style="margin-top: -10px">{!! $icons->getIcon('copy') !!}</i>
                                    <input type="text" value="{{ route('single-post', ['useruuid' => $post->user->uuid, 'postuuid' => $post->uuid]) }}" class="bg-grey text-grey-500 font-xssss border-0 lh-32 p-2 font-xssss fw-600 rounded-3 w-100 theme-dark-bg">
                                </div>
                            </div>

                            <form method="POST" wire:submit.prevent="saveComment({{ $post->id }})">
                                <input type="text" placeholder="write your comments here..." required
                                    name="comment" wire:model.lazy="comment"
                                    class="p-2 border-0 bg-grey text-grey-500 font-xssss lh-32 fw-600 rounded-3 w-100 theme-dark-bg"
                                    id="">
                            </form>
                        </div>

                    @empty
                        <h1 class="text-center text-danger"> No New Posts Found !!</h1>
                    @endforelse


                    {{-- All other extra posts --}}
                    <div class="card w-100 shadow-xss rounded-xxl border-0 p-4 mb-0">
                        <div class="card-body p-0 d-flex">
                            <figure class="avatar me-3 m-0"><img src="images/user-8.png" alt="image" class="shadow-sm rounded-circle w45"></figure>
                            <h4 class="fw-700 text-grey-900 font-xssss mt-1">Goria Coast  <span class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">2 hour ago</span></h4>
                            <a href="#" class="ms-auto" id="dropdownMenu6" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti-more-alt text-grey-900 btn-round-md bg-greylight font-xss"></i></a>
                            <div class="dropdown-menu dropdown-menu-end p-4 rounded-xxl border-0 shadow-lg" aria-labelledby="dropdownMenu6">
                                <div class="card-body p-0 d-flex">
                                    <i class="feather-bookmark text-grey-500 me-3 font-lg"></i>
                                    <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4">Save Link <span class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Add this to your saved items</span></h4>
                                </div>
                                <div class="card-body p-0 d-flex mt-2">
                                    <i class="feather-alert-circle text-grey-500 me-3 font-lg"></i>
                                    <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4">Hide Post <span class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Save to your saved items</span></h4>
                                </div>
                                <div class="card-body p-0 d-flex mt-2">
                                    <i class="feather-alert-octagon text-grey-500 me-3 font-lg"></i>
                                    <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4">Hide all from Group <span class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Save to your saved items</span></h4>
                                </div>
                                <div class="card-body p-0 d-flex mt-2">
                                    <i class="feather-lock text-grey-500 me-3 font-lg"></i>
                                    <h4 class="fw-600 mb-0 text-grey-900 font-xssss mt-0 me-4">Unfollow Group <span class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Save to your saved items</span></h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0 me-lg-5">
                            <p class="fw-500 text-grey-500 lh-26 font-xssss w-100">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nulla dolor, ornare at commodo non, feugiat non nisi. Phasellus faucibus mollis pharetra. Proin blandit ac massa sed rhoncus <a href="#" class="fw-600 text-primary ms-2">See more</a></p>
                        </div>
                        <div class="card-body d-flex p-0">
                            <a href="#" class="emoji-bttn d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss me-2"><i class="feather-thumbs-up text-white bg-primary-gradiant me-1 btn-round-xs font-xss"></i> <i class="feather-heart text-white bg-red-gradiant me-2 btn-round-xs font-xss"></i>2.8K Like</a>
                            <div class="emoji-wrap">
                                <ul class="emojis list-inline mb-0">
                                    <li class="emoji list-inline-item"><i class="em em---1"></i> </li>
                                    <li class="emoji list-inline-item"><i class="em em-angry"></i></li>
                                    <li class="emoji list-inline-item"><i class="em em-anguished"></i> </li>
                                    <li class="emoji list-inline-item"><i class="em em-astonished"></i> </li>
                                    <li class="emoji list-inline-item"><i class="em em-blush"></i></li>
                                    <li class="emoji list-inline-item"><i class="em em-clap"></i></li>
                                    <li class="emoji list-inline-item"><i class="em em-cry"></i></li>
                                    <li class="emoji list-inline-item"><i class="em em-full_moon_with_face"></i></li>
                                </ul>
                            </div>
                            <a href="#" class="d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss"><i class="feather-message-circle text-dark text-grey-900 btn-round-sm font-lg"></i><span class="d-none-xss">22 Comment</span></a>
                            <a href="#" id="dropdownMenu31" data-bs-toggle="dropdown" aria-expanded="false" class="ms-auto d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss"><i class="feather-share-2 text-grey-900 text-dark btn-round-sm font-lg"></i><span class="d-none-xs">Share</span></a>
                            <div class="dropdown-menu dropdown-menu-end p-4 rounded-xxl border-0 shadow-lg" aria-labelledby="dropdownMenu31">
                                <h4 class="fw-700 font-xss text-grey-900 d-flex align-items-center">Share <i class="feather-x ms-auto font-xssss btn-round-xs bg-greylight text-grey-900 me-2"></i></h4>
                                <div class="card-body p-0 d-flex">
                                    <ul class="d-flex align-items-center justify-content-between mt-2">
                                        <li class="me-1"><a href="#" class="btn-round-lg bg-facebook"><i class="font-xs ti-facebook text-white"></i></a></li>
                                        <li class="me-1"><a href="#" class="btn-round-lg bg-twiiter"><i class="font-xs ti-twitter-alt text-white"></i></a></li>
                                        <li class="me-1"><a href="#" class="btn-round-lg bg-linkedin"><i class="font-xs ti-linkedin text-white"></i></a></li>
                                        <li class="me-1"><a href="#" class="btn-round-lg bg-instagram"><i class="font-xs ti-instagram text-white"></i></a></li>
                                        <li><a href="#" class="btn-round-lg bg-pinterest"><i class="font-xs ti-pinterest text-white"></i></a></li>
                                    </ul>
                                </div>
                                <div class="card-body p-0 d-flex">
                                    <ul class="d-flex align-items-center justify-content-between mt-2">
                                        <li class="me-1"><a href="#" class="btn-round-lg bg-tumblr"><i class="font-xs ti-tumblr text-white"></i></a></li>
                                        <li class="me-1"><a href="#" class="btn-round-lg bg-youtube"><i class="font-xs ti-youtube text-white"></i></a></li>
                                        <li class="me-1"><a href="#" class="btn-round-lg bg-flicker"><i class="font-xs ti-flickr text-white"></i></a></li>
                                        <li class="me-1"><a href="#" class="btn-round-lg bg-black"><i class="font-xs ti-vimeo-alt text-white"></i></a></li>
                                        <li><a href="#" class="btn-round-lg bg-whatsup"><i class="font-xs feather-phone text-white"></i></a></li>
                                    </ul>
                                </div>
                                <h4 class="fw-700 font-xssss mt-4 text-grey-500 d-flex align-items-center mb-3">Copy Link</h4>
                                <i class="feather-copy position-absolute right-35 mt-3 font-xs text-grey-500"></i>
                                <input type="text" value="https://socia.be/1rGxjoJKVF0" class="bg-grey text-grey-500 font-xssss border-0 lh-32 p-2 font-xssss fw-600 rounded-3 w-100 theme-dark-bg">
                            </div>
                        </div>
                    </div>

                    <div class="card w-100 shadow-none bg-transparent bg-transparent-card border-0 p-0 mb-0">
                        <div class="owl-carousel category-card owl-theme overflow-hidden nav-none">
                            <div class="item">
                                <div class="card w200 d-block border-0 shadow-xss rounded-xxl overflow-hidden mb-3 me-2 mt-3">
                                    <div class="card-body position-relative h100 bg-image-cover bg-image-center" style="background-image: url(images/u-bg.jpg);"></div>
                                    <div class="card-body d-block w-100 ps-4 pe-4 pb-4 text-center">
                                        <figure class="avatar ms-auto me-auto mb-0 mt--6 position-relative w75 z-index-1"><img src="images/user-11.png" alt="image" class="float-right p-1 bg-white rounded-circle w-100"></figure>
                                        <div class="clearfix"></div>
                                        <h4 class="fw-700 font-xsss mt-2 mb-1">Aliqa Macale </h4>
                                        <p class="fw-500 font-xsssss text-grey-500 mt-0 mb-2">support@gmail.com</p>
                                        <span class="live-tag mt-2 mb-0 bg-danger p-2 z-index-1 rounded-3 text-white font-xsssss text-uppersace fw-700 ls-3">LIVE</span>
                                        <div class="clearfix mb-2"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="item">
                                <div class="card w200 d-block border-0 shadow-xss rounded-xxl overflow-hidden mb-3 me-2 mt-3">
                                    <div class="card-body position-relative h100 bg-image-cover bg-image-center" style="background-image: url(images/s-2.jpg);"></div>
                                    <div class="card-body d-block w-100 ps-4 pe-4 pb-4 text-center">
                                        <figure class="avatar ms-auto me-auto mb-0 mt--6 position-relative w75 z-index-1"><img src="images/user-2.png" alt="image" class="float-right p-1 bg-white rounded-circle w-100"></figure>
                                        <div class="clearfix"></div>
                                        <h4 class="fw-700 font-xsss mt-2 mb-1">Seary Victor </h4>
                                        <p class="fw-500 font-xsssss text-grey-500 mt-0 mb-2">support@gmail.com</p>
                                        <span class="live-tag mt-2 mb-0 bg-danger p-2 z-index-1 rounded-3 text-white font-xsssss text-uppersace fw-700 ls-3">LIVE</span>
                                        <div class="clearfix mb-2"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="item">
                                <div class="card w200 d-block border-0 shadow-xss rounded-xxl overflow-hidden mb-3 me-2 mt-3">
                                    <div class="card-body position-relative h100 bg-image-cover bg-image-center" style="background-image: url(images/s-6.jpg);"></div>
                                    <div class="card-body d-block w-100 ps-4 pe-4 pb-4 text-center">
                                        <figure class="avatar ms-auto me-auto mb-0 mt--6 position-relative w75 z-index-1"><img src="images/user-3.png" alt="image" class="float-right p-1 bg-white rounded-circle w-100"></figure>
                                        <div class="clearfix"></div>
                                        <h4 class="fw-700 font-xsss mt-2 mb-1">John Steere </h4>
                                        <p class="fw-500 font-xsssss text-grey-500 mt-0 mb-2">support@gmail.com</p>
                                        <span class="live-tag mt-2 mb-0 bg-danger p-2 z-index-1 rounded-3 text-white font-xsssss text-uppersace fw-700 ls-3">LIVE</span>
                                        <div class="clearfix mb-2"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="item">
                                <div class="card w200 d-block border-0 shadow-xss rounded-xxl overflow-hidden mb-3 me-2 mt-3">
                                    <div class="card-body position-relative h100 bg-image-cover bg-image-center" style="background-image: url(images/bb-16.png);"></div>
                                    <div class="card-body d-block w-100 ps-4 pe-4 pb-4 text-center">
                                        <figure class="avatar ms-auto me-auto mb-0 mt--6 position-relative w75 z-index-1"><img src="images/user-4.png" alt="image" class="float-right p-1 bg-white rounded-circle w-100"></figure>
                                        <div class="clearfix"></div>
                                        <h4 class="fw-700 font-xsss mt-2 mb-1">Mohannad Zitoun </h4>
                                        <p class="fw-500 font-xsssss text-grey-500 mt-0 mb-2">support@gmail.com</p>
                                        <span class="live-tag mt-2 mb-0 bg-danger p-2 z-index-1 rounded-3 text-white font-xsssss text-uppersace fw-700 ls-3">LIVE</span>
                                        <div class="clearfix mb-2"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="item">
                                <div class="card w200 d-block border-0 shadow-xss rounded-xxl overflow-hidden mb-3 me-2 mt-3">
                                    <div class="card-body position-relative h100 bg-image-cover bg-image-center" style="background-image: url(images/e-4.jpg);"></div>
                                    <div class="card-body d-block w-100 ps-4 pe-4 pb-4 text-center">
                                        <figure class="avatar ms-auto me-auto mb-0 mt--6 position-relative w75 z-index-1"><img src="images/user-7.png" alt="image" class="float-right p-1 bg-white rounded-circle w-100"></figure>
                                        <div class="clearfix"></div>
                                        <h4 class="fw-700 font-xsss mt-2 mb-1">Studio Express </h4>
                                        <p class="fw-500 font-xsssss text-grey-500 mt-0 mb-2">support@gmail.com</p>
                                        <span class="live-tag mt-2 mb-0 bg-danger p-2 z-index-1 rounded-3 text-white font-xsssss text-uppersace fw-700 ls-3">LIVE</span>
                                        <div class="clearfix mb-2"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="item">
                                <div class="card w200 d-block border-0 shadow-xss rounded-xxl overflow-hidden mb-3 me-2 mt-3">
                                    <div class="card-body position-relative h100 bg-image-cover bg-image-center" style="background-image: url(images/coming-soon.png);"></div>
                                    <div class="card-body d-block w-100 ps-4 pe-4 pb-4 text-center">
                                        <figure class="avatar ms-auto me-auto mb-0 mt--6 position-relative w75 z-index-1"><img src="images/user-5.png" alt="image" class="float-right p-1 bg-white rounded-circle w-100"></figure>
                                        <div class="clearfix"></div>
                                        <h4 class="fw-700 font-xsss mt-2 mb-1">Hendrix Stamp </h4>
                                        <p class="fw-500 font-xsssss text-grey-500 mt-0 mb-2">support@gmail.com</p>
                                        <span class="live-tag mt-2 mb-0 bg-danger p-2 z-index-1 rounded-3 text-white font-xsssss text-uppersace fw-700 ls-3">LIVE</span>
                                        <div class="clearfix mb-2"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="item">
                                <div class="card w200 d-block border-0 shadow-xss rounded-xxl overflow-hidden mb-3 me-2 mt-3">
                                    <div class="card-body position-relative h100 bg-image-cover bg-image-center" style="background-image: url(images/bb-9.jpg);"></div>
                                    <div class="card-body d-block w-100 ps-4 pe-4 pb-4 text-center">
                                        <figure class="avatar ms-auto me-auto mb-0 mt--6 position-relative w75 z-index-1"><img src="images/user-6.png" alt="image" class="float-right p-1 bg-white rounded-circle w-100"></figure>
                                        <div class="clearfix"></div>
                                        <h4 class="fw-700 font-xsss mt-2 mb-1">Mohannad Zitoun </h4>
                                        <p class="fw-500 font-xsssss text-grey-500 mt-0 mb-2">support@gmail.com</p>
                                        <span class="live-tag mt-2 mb-0 bg-danger p-2 z-index-1 rounded-3 text-white font-xsssss text-uppersace fw-700 ls-3">LIVE</span>
                                        <div class="clearfix mb-2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card w-100 shadow-xss rounded-xxl border-0 p-4 mb-3">
                        <div class="card-body p-0 d-flex">
                            <figure class="avatar me-3"><img src="images/user-8.png" alt="image" class="shadow-sm rounded-circle w45"></figure>
                            <h4 class="fw-700 text-grey-900 font-xssss mt-1">Anthony Daugloi <span class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">2 hour ago</span></h4>
                            <a href="#" class="ms-auto" id="dropdownMenu5" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti-more-alt text-grey-900 btn-round-md bg-greylight font-xss"></i></a>
                            <div class="dropdown-menu dropdown-menu-start p-4 rounded-xxl border-0 shadow-lg" aria-labelledby="dropdownMenu5">
                                <div class="card-body p-0 d-flex">
                                    <i class="feather-bookmark text-grey-500 me-3 font-lg"></i>
                                    <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4">Save Link <span class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Add this to your saved items</span></h4>
                                </div>
                                <div class="card-body p-0 d-flex mt-2">
                                    <i class="feather-alert-circle text-grey-500 me-3 font-lg"></i>
                                    <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4">Hide Post <span class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Save to your saved items</span></h4>
                                </div>
                                <div class="card-body p-0 d-flex mt-2">
                                    <i class="feather-alert-octagon text-grey-500 me-3 font-lg"></i>
                                    <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4">Hide all from Group <span class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Save to your saved items</span></h4>
                                </div>
                                <div class="card-body p-0 d-flex mt-2">
                                    <i class="feather-lock text-grey-500 me-3 font-lg"></i>
                                    <h4 class="fw-600 mb-0 text-grey-900 font-xssss mt-0 me-4">Unfollow Group <span class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Save to your saved items</span></h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0 mb-3 rounded-3 overflow-hidden">
                            <a href="default-video.html" class="video-btn">
                                <video autoplay loop class="float-right w-100">
                                    <source src="images/v-2.mp4" type="video/mp4">
                                </video>
                            </a>
                        </div>
                        <div class="card-body p-0 me-lg-5">
                            <p class="fw-500 text-grey-500 lh-26 font-xssss w-100 mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nulla dolor, ornare at commodo non, feugiat non nisi. Phasellus faucibus mollis pharetra. Proin blandit ac massa sed rhoncus <a href="#" class="fw-600 text-primary ms-2">See more</a></p>
                        </div>
                        <div class="card-body d-flex p-0">
                            <a href="#" class="emoji-bttn d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss me-2"><i class="feather-thumbs-up text-white bg-primary-gradiant me-1 btn-round-xs font-xss"></i> <i class="feather-heart text-white bg-red-gradiant me-2 btn-round-xs font-xss"></i>2.8K Like</a>
                            <div class="emoji-wrap">
                                <ul class="emojis list-inline mb-0">
                                    <li class="emoji list-inline-item"><i class="em em---1"></i> </li>
                                    <li class="emoji list-inline-item"><i class="em em-angry"></i></li>
                                    <li class="emoji list-inline-item"><i class="em em-anguished"></i> </li>
                                    <li class="emoji list-inline-item"><i class="em em-astonished"></i> </li>
                                    <li class="emoji list-inline-item"><i class="em em-blush"></i></li>
                                    <li class="emoji list-inline-item"><i class="em em-clap"></i></li>
                                    <li class="emoji list-inline-item"><i class="em em-cry"></i></li>
                                    <li class="emoji list-inline-item"><i class="em em-full_moon_with_face"></i></li>
                                </ul>
                            </div>
                            <a href="#" class="d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss"><i class="feather-message-circle text-dark text-grey-900 btn-round-sm font-lg"></i><span class="d-none-xss">22 Comment</span></a>
                            <a href="#" class="ms-auto d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss"><i class="feather-share-2 text-grey-900 text-dark btn-round-sm font-lg"></i><span class="d-none-xs">Share</span></a>
                        </div>
                    </div>

                    <div class="card w-100 shadow-xss rounded-xxl border-0 p-4 mb-0">
                        <div class="card-body p-0 d-flex">
                            <figure class="avatar me-3"><img src="images/user-8.png" alt="image" class="shadow-sm rounded-circle w45"></figure>
                            <h4 class="fw-700 text-grey-900 font-xssss mt-1">Anthony Daugloi <span class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">2 hour ago</span></h4>
                            <a href="#" class="ms-auto"><i class="ti-more-alt text-grey-900 btn-round-md bg-greylight font-xss"></i></a>
                        </div>

                        <div class="card-body p-0 me-lg-5">
                            <p class="fw-500 text-grey-500 lh-26 font-xssss w-100">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nulla dolor, ornare at commodo non, feugiat non nisi. Phasellus faucibus mollis pharetra. Proin blandit ac massa sed rhoncus <a href="#" class="fw-600 text-primary ms-2">See more</a></p>
                        </div>
                        <div class="card-body d-block p-0 mb-3">
                            <div class="row ps-2 pe-2">
                                <div class="col-xs-6 col-sm-6 p-1"><a href="images/t-36.jpg" data-lightbox="roadtri"><img src="images/t-21.jpg" class="rounded-3 w-100" alt="image"></a></div>
                                <div class="col-xs-6 col-sm-6 p-1"><a href="images/t-32.jpg" data-lightbox="roadtri"><img src="images/t-22.jpg" class="rounded-3 w-100" alt="image"></a></div>
                            </div>
                            <div class="row ps-2 pe-2">
                                <div class="col-xs-4 col-sm-4 p-1"><a href="images/t-33.jpg" data-lightbox="roadtri"><img src="images/t-23.jpg" class="rounded-3 w-100" alt="image"></a></div>
                                <div class="col-xs-4 col-sm-4 p-1"><a href="images/t-34.jpg" data-lightbox="roadtri"><img src="images/t-24.jpg" class="rounded-3 w-100" alt="image"></a></div>
                                <div class="col-xs-4 col-sm-4 p-1"><a href="images/t-35.jpg" data-lightbox="roadtri" class="position-relative d-block"><img src="images/t-25.jpg" class="rounded-3 w-100" alt="image"><span class="img-count font-sm text-white ls-3 fw-600"><b>+2</b></span></a></div>
                            </div>
                        </div>
                        <div class="card-body d-flex p-0">
                            <a href="#" class="emoji-bttn d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss me-2"><i class="feather-thumbs-up text-white bg-primary-gradiant me-1 btn-round-xs font-xss"></i> <i class="feather-heart text-white bg-red-gradiant me-2 btn-round-xs font-xss"></i>2.8K Like</a>
                            <div class="emoji-wrap">
                                <ul class="emojis list-inline mb-0">
                                    <li class="emoji list-inline-item"><i class="em em---1"></i> </li>
                                    <li class="emoji list-inline-item"><i class="em em-angry"></i></li>
                                    <li class="emoji list-inline-item"><i class="em em-anguished"></i> </li>
                                    <li class="emoji list-inline-item"><i class="em em-astonished"></i> </li>
                                    <li class="emoji list-inline-item"><i class="em em-blush"></i></li>
                                    <li class="emoji list-inline-item"><i class="em em-clap"></i></li>
                                    <li class="emoji list-inline-item"><i class="em em-cry"></i></li>
                                    <li class="emoji list-inline-item"><i class="em em-full_moon_with_face"></i></li>
                                </ul>
                            </div>
                            <a href="#" class="d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss"><i class="feather-message-circle text-dark text-grey-900 btn-round-sm font-lg"></i><span class="d-none-xss">22 Comment</span></a>
                            <a href="#" class="ms-auto d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss"><i class="feather-share-2 text-grey-900 text-dark btn-round-sm font-lg"></i><span class="d-none-xs">Share</span></a>
                        </div>
                    </div>

                    <div class="card w-100 shadow-none bg-transparent bg-transparent-card border-0 p-0 mb-0">
                        <div class="owl-carousel category-card owl-theme overflow-hidden nav-none">
                            <div class="item">
                                <div class="card w150 d-block border-0 shadow-xss rounded-3 overflow-hidden mb-3 me-2 mt-3">
                                    <div class="card-body d-block w-100 ps-3 pe-3 pb-4 text-center">
                                        <figure class="avatar ms-auto me-auto mb-0 position-relative w65 z-index-1"><img src="images/user-11.png" alt="image" class="float-right p-0 bg-white rounded-circle w-100 shadow-xss"></figure>
                                        <div class="clearfix"></div>
                                        <h4 class="fw-700 font-xssss mt-3 mb-1">Richard Bowers  </h4>
                                        <p class="fw-500 font-xsssss text-grey-500 mt-0 mb-3">@macale343</p>
                                        <a href="#" class="text-center p-2 lh-20 w100 ms-1 ls-3 d-inline-block rounded-xl bg-success font-xsssss fw-700 ls-lg text-white">FOLLOW</a>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="card w150 d-block border-0 shadow-xss rounded-3 overflow-hidden mb-3 me-2 mt-3">
                                    <div class="card-body d-block w-100 ps-3 pe-3 pb-4 text-center">
                                        <figure class="avatar ms-auto me-auto mb-0 position-relative w65 z-index-1"><img src="images/user-9.png" alt="image" class="float-right p-0 bg-white rounded-circle w-100 shadow-xss"></figure>
                                        <div class="clearfix"></div>
                                        <h4 class="fw-700 font-xssss mt-3 mb-1">David Goria </h4>
                                        <p class="fw-500 font-xsssss text-grey-500 mt-0 mb-3">@macale343</p>
                                        <a href="#" class="text-center p-2 lh-20 w100 ms-1 ls-3 d-inline-block rounded-xl bg-success font-xsssss fw-700 ls-lg text-white">FOLLOW</a>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="card w150 d-block border-0 shadow-xss rounded-3 overflow-hidden mb-3 me-2 mt-3">
                                    <div class="card-body d-block w-100 ps-3 pe-3 pb-4 text-center">
                                        <figure class="avatar ms-auto me-auto mb-0 position-relative w65 z-index-1"><img src="images/user-12.png" alt="image" class="float-right p-0 bg-white rounded-circle w-100 shadow-xss"></figure>
                                        <div class="clearfix"></div>
                                        <h4 class="fw-700 font-xssss mt-3 mb-1">Vincent Parks  </h4>
                                        <p class="fw-500 font-xsssss text-grey-500 mt-0 mb-3">@macale343</p>
                                        <a href="#" class="text-center p-2 lh-20 w100 ms-1 ls-3 d-inline-block rounded-xl bg-success font-xsssss fw-700 ls-lg text-white">FOLLOW</a>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="card w150 d-block border-0 shadow-xss rounded-3 overflow-hidden mb-3 me-2 mt-3">
                                    <div class="card-body d-block w-100 ps-3 pe-3 pb-4 text-center">
                                        <figure class="avatar ms-auto me-auto mb-0 position-relative w65 z-index-1"><img src="images/user-8.png" alt="image" class="float-right p-0 bg-white rounded-circle w-100 shadow-xss"></figure>
                                        <div class="clearfix"></div>
                                        <h4 class="fw-700 font-xssss mt-3 mb-1">Studio Express </h4>
                                        <p class="fw-500 font-xsssss text-grey-500 mt-0 mb-3">@macale343</p>
                                        <a href="#" class="text-center p-2 lh-20 w100 ms-1 ls-3 d-inline-block rounded-xl bg-success font-xsssss fw-700 ls-lg text-white">FOLLOW</a>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="card w150 d-block border-0 shadow-xss rounded-3 overflow-hidden mb-3 me-2 mt-3">
                                    <div class="card-body d-block w-100 ps-3 pe-3 pb-4 text-center">
                                        <figure class="avatar ms-auto me-auto mb-0 position-relative w65 z-index-1"><img src="images/user-7.png" alt="image" class="float-right p-0 bg-white rounded-circle w-100 shadow-xss"></figure>
                                        <div class="clearfix"></div>
                                        <h4 class="fw-700 font-xssss mt-3 mb-1">Aliqa Macale </h4>
                                        <p class="fw-500 font-xsssss text-grey-500 mt-0 mb-3">@macale343</p>
                                        <a href="#" class="text-center p-2 lh-20 w100 ms-1 ls-3 d-inline-block rounded-xl bg-success font-xsssss fw-700 ls-lg text-white">FOLLOW</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="card w-100 shadow-xss rounded-xxl border-0 p-4 mb-3">
                        <div class="card-body p-0 d-flex">
                            <figure class="avatar me-3"><img src="images/user-8.png" alt="image" class="shadow-sm rounded-circle w45"></figure>
                            <h4 class="fw-700 text-grey-900 font-xssss mt-1">Anthony Daugloi <span class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">2 hour ago</span></h4>
                            <a href="#" class="ms-auto"><i class="ti-more-alt text-grey-900 btn-round-md bg-greylight font-xss"></i></a>
                        </div>
                        <div class="card-body p-0 mb-3 rounded-3 overflow-hidden">
                            <a href="default-video.html" class="video-btn">
                                <video autoplay loop class="float-right w-100">
                                    <source src="images/v-1.mp4" type="video/mp4">
                                </video>
                            </a>
                        </div>
                        <div class="card-body p-0 me-lg-5">
                            <p class="fw-500 text-grey-500 lh-26 font-xssss w-100 mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nulla dolor, ornare at commodo non, feugiat non nisi. Phasellus faucibus mollis pharetra. Proin blandit ac massa sed rhoncus <a href="#" class="fw-600 text-primary ms-2">See more</a></p>
                        </div>
                        <div class="card-body d-flex p-0">
                            <a href="#" class="emoji-bttn d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss me-2"><i class="feather-thumbs-up text-white bg-primary-gradiant me-1 btn-round-xs font-xss"></i> <i class="feather-heart text-white bg-red-gradiant me-2 btn-round-xs font-xss"></i>2.8K Like</a>
                            <div class="emoji-wrap">
                                <ul class="emojis list-inline mb-0">
                                    <li class="emoji list-inline-item"><i class="em em---1"></i> </li>
                                    <li class="emoji list-inline-item"><i class="em em-angry"></i></li>
                                    <li class="emoji list-inline-item"><i class="em em-anguished"></i> </li>
                                    <li class="emoji list-inline-item"><i class="em em-astonished"></i> </li>
                                    <li class="emoji list-inline-item"><i class="em em-blush"></i></li>
                                    <li class="emoji list-inline-item"><i class="em em-clap"></i></li>
                                    <li class="emoji list-inline-item"><i class="em em-cry"></i></li>
                                    <li class="emoji list-inline-item"><i class="em em-full_moon_with_face"></i></li>
                                </ul>
                            </div>
                            <a href="#" class="d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss"><i class="feather-message-circle text-dark text-grey-900 btn-round-sm font-lg"></i><span class="d-none-xss">22 Comment</span></a>
                            <a href="#" class="ms-auto d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss"><i class="feather-share-2 text-grey-900 text-dark btn-round-sm font-lg"></i><span class="d-none-xs">Share</span></a>
                        </div>
                    </div>

                    <div class="card w-100 shadow-xss rounded-xxl border-0 p-4 mb-0">
                        <div class="card-body p-0 d-flex">
                            <figure class="avatar me-3"><img src="images/user-8.png" alt="image" class="shadow-sm rounded-circle w45"></figure>
                            <h4 class="fw-700 text-grey-900 font-xssss mt-1">Anthony Daugloi <span class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">2 hour ago</span></h4>
                            <a href="#" class="ms-auto"><i class="ti-more-alt text-grey-900 btn-round-md bg-greylight font-xss"></i></a>
                        </div>
                        <div class="card-body p-0 me-lg-5">
                            <p class="fw-500 text-grey-500 lh-26 font-xssss w-100 mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nulla dolor, ornare at commodo non, feugiat non nisi. Phasellus faucibus mollis pharetra. Proin blandit ac massa sed rhoncus <a href="#" class="fw-600 text-primary ms-2">See more</a></p>
                        </div>
                        <div class="card-body d-block p-0 mb-3">
                            <div class="row ps-2 pe-2">
                                <div class="col-sm-12 p-1"><a href="images/t-30.jpg" data-lightbox="roadtr"><img src="images/t-31.jpg" class="rounded-3 w-100" alt="image"></a></div>
                            </div>
                        </div>
                        <div class="card-body d-flex p-0">
                            <a href="#" class="emoji-bttn d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss me-2"><i class="feather-thumbs-up text-white bg-primary-gradiant me-1 btn-round-xs font-xss"></i> <i class="feather-heart text-white bg-red-gradiant me-2 btn-round-xs font-xss"></i>2.8K Like</a>
                            <div class="emoji-wrap">
                                <ul class="emojis list-inline mb-0">
                                    <li class="emoji list-inline-item"><i class="em em---1"></i> </li>
                                    <li class="emoji list-inline-item"><i class="em em-angry"></i></li>
                                    <li class="emoji list-inline-item"><i class="em em-anguished"></i> </li>
                                    <li class="emoji list-inline-item"><i class="em em-astonished"></i> </li>
                                    <li class="emoji list-inline-item"><i class="em em-blush"></i></li>
                                    <li class="emoji list-inline-item"><i class="em em-clap"></i></li>
                                    <li class="emoji list-inline-item"><i class="em em-cry"></i></li>
                                    <li class="emoji list-inline-item"><i class="em em-full_moon_with_face"></i></li>
                                </ul>
                            </div>
                            <a href="#" class="d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss"><i class="feather-message-circle text-dark text-grey-900 btn-round-sm font-lg"></i><span class="d-none-xss">22 Comment</span></a>
                            <a href="#" class="ms-auto d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss"><i class="feather-share-2 text-grey-900 text-dark btn-round-sm font-lg"></i><span class="d-none-xs">Share</span></a>
                        </div>
                    </div>


                    <div class="card w-100 text-center shadow-xss rounded-xxl border-0 p-4 mb-3 mt-3">
                        <div class="snippet mt-2 ms-auto me-auto" data-title=".dot-typing">
                            <div class="stage">
                                <div class="dot-typing"></div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="col-xl-4 col-xxl-3 col-lg-4 ps-lg-0">
                    {{-- Display the friend request bar in the home page --}}
                    {{-- if the friend request count is zero remove the this section displaying there --}}
                    @if (count($friend_requests))
                    <div class="mb-3 border-0 card w-100 shadow-xss rounded-xxl">
                        <div class="p-4 card-body d-flex align-items-center">
                            <h4 class="mb-0 fw-700 font-xssss text-grey-900">Friend Request</h4>
                            <a href="{{ route('explore') }}" class="fw-600 ms-auto font-xssss text-primary">See
                                all</a>
                        </div>
                        {{-- set a loop to retrieve all the friend request they sent to the user --}}
                        @forelse ($friend_requests as $user)
                            <div class="pt-4 pb-0 card-body d-flex ps-4 pe-4 border-top-xs bor-0">
                                <figure class="avatar me-3"><img
                                        src="{{ asset('storage') . '/' . $user->user->profile }}" alt="image"
                                        class="shadow-sm rounded-circle w45"></figure>
                                <h4 class="mt-1 fw-700 text-grey-900 font-xssss">
                                    {{ $user->user->first_name . ' ' . $user->user->last_name }} <span
                                        class="mt-1 d-block font-xssss fw-500 lh-3 text-grey-500">12 mutual
                                        friends</span>
                                </h4>
                            </div>
                            {{-- user able to confirm the reuest or delete the request from this buttons --}}
                            <div class="pt-0 pb-4 card-body d-flex align-items-center ps-4 pe-4">
                                <button wire:click="acceptfriend({{ $user->user_id }})"
                                    class="p-2 text-center text-white lh-20 w100 bg-primary-gradiant me-2 font-xssss fw-600 ls-1 rounded-xl">Confirm</button>
                                <button wire:click="rejectfriend({{ $user->user_id }})"
                                    class="p-2 text-center lh-20 w100 bg-grey text-grey-800 font-xssss fw-600 ls-1 rounded-xl">Delete</button>
                            </div>
                        @empty
                        @endforelse

                    </div>
                    @endif


                    <div class="card w-100 shadow-xss rounded-xxl border-0 p-0 ">
                        <div class="card-body d-flex align-items-center p-4 mb-0">
                            <h4 class="fw-700 mb-0 font-xssss text-grey-900">Friend Suggestions</h4>
                            <a href="{{ route('explore') }}" class="fw-600 ms-auto font-xssss text-primary">See all</a>
                        </div>

                        @foreach ($suggested_friends as $user)
                        <div
                            class="p-3 mb-3 card-body bg-transparent-card d-flex bg-greylight ms-3 me-3 rounded-3">
                            <figure class="mb-0 avatar me-2"><img
                                    src="{{ asset('storage') . '/' . $user->profile }}" alt="image"
                                    class="shadow-sm rounded-circle w45"></figure>
                            <h4 class="mt-2 fw-700 text-grey-900 font-xssss">
                                {{ $user->first_name . ' ' . $user->last_name }} <span
                                    class="mt-1 d-block font-xssss fw-500 lh-3 text-grey-500">{{ $user->mutual_friends() }}
                                    mutual
                                    friends</span>
                            </h4>
                            <a href="{{ route('user', $user->uuid) }}"
                                class="mt-2 bg-white btn-round-sm text-grey-900  font-xss ms-auto"
                                style="margint-top:-10px">{!! $icons->getIcon('chevron-right') !!}</a>
                        </div>
                    @endforeach

                    </div>

                        {{-- New Group Suggestions for home page --}}
                        <div class="mt-3 mb-3 border-0 card w-100 shadow-xss rounded-xxl">
                            <div class="p-4 card-body d-flex align-items-center">
                                <h4 class="mb-0 fw-700 font-xssss text-grey-900">Suggest Groups </h4>
                                <a href="{{ route('groups') }}" class="fw-600 ms-auto font-xssss text-primary">See
                                    all</a>
                            </div>

                            @forelse ($suggested_groups as $group)
                                <div class="pt-4 pb-0 overflow-hidden card-body d-flex ps-4 pe-4 border-top-xs bor-0">
                                    <img src="{{ asset('storage') . '/' . $group->thumbnail }}" alt="img"
                                        class="mb-2 img-fluid rounded-xxl">
                                </div>
                                <div class="pt-0 pb-4 card-body d-flex align-items-center ps-4 pe-4">
                                    <a style="cursor: pointer" wire:click="join({{ $group->id }})"
                                        title="like {{ $group->name }}"
                                        class="p-2 text-center lh-28 w-100 bg-grey text-grey-800 font-xssss fw-700 rounded-xl"><i
                                            class=" font-xss me-2" style="margin-top: -10px">{!! $icons->getIcon('external-link') !!}</i>
                                        Join</a>
                                </div>
                            @empty
                                <p class="text-center text-danger">No New Groups Found</p>
                            @endforelse
                        </div>

                    <div class="card w-100 shadow-xss rounded-xxl border-0 mb-3">
                        <div class="card-body d-flex align-items-center p-4">
                            <h4 class="fw-700 mb-0 font-xssss text-grey-900">Suggest Pages</h4>
                            <a href="default-group.html" class="fw-600 ms-auto font-xssss text-primary">See all</a>
                        </div>
                        <div class="card-body d-flex pt-4 ps-4 pe-4 pb-0 overflow-hidden border-top-xs bor-0">
                            <img src="images/g-2.jpg" alt="img" class="img-fluid rounded-xxl mb-2">
                        </div>
                        <div class="card-body d-flex align-items-center pt-0 ps-4 pe-4 pb-4">
                            <a href="#" class="p-2 lh-28 w-100 bg-grey text-grey-800 text-center font-xssss fw-700 rounded-xl"><i class="feather-external-link font-xss me-2"></i> Like Page</a>
                        </div>

                        <div class="card-body d-flex pt-0 ps-4 pe-4 pb-0 overflow-hidden">
                            <img src="images/g-3.jpg" alt="img" class="img-fluid rounded-xxl mb-2 bg-lightblue">
                        </div>
                        <div class="card-body d-flex align-items-center pt-0 ps-4 pe-4 pb-4">
                            <a href="#" class="p-2 lh-28 w-100 bg-grey text-grey-800 text-center font-xssss fw-700 rounded-xl"><i class="feather-external-link font-xss me-2"></i> Like Page</a>
                        </div>


                    </div>


                    <div class="card w-100 shadow-xss rounded-xxl border-0 mb-3">
                        <div class="card-body d-flex align-items-center  p-4">
                            <h4 class="fw-700 mb-0 font-xssss text-grey-900">Event</h4>
                            <a href="default-event.html" class="fw-600 ms-auto font-xssss text-primary">See all</a>
                        </div>
                        <div class="card-body d-flex pt-0 ps-4 pe-4 pb-3 overflow-hidden">
                            <div class="bg-success me-2 p-3 rounded-xxl"><h4 class="fw-700 font-lg ls-3 lh-1 text-white mb-0"><span class="ls-1 d-block font-xsss text-white fw-600">FEB</span>22</h4></div>
                            <h4 class="fw-700 text-grey-900 font-xssss mt-2">Meeting with clients <span class="d-block font-xsssss fw-500 mt-1 lh-4 text-grey-500">41 madison ave, floor 24 new work, NY 10010</span> </h4>
                        </div>

                        <div class="card-body d-flex pt-0 ps-4 pe-4 pb-3 overflow-hidden">
                            <div class="bg-warning me-2 p-3 rounded-xxl"><h4 class="fw-700 font-lg ls-3 lh-1 text-white mb-0"><span class="ls-1 d-block font-xsss text-white fw-600">APR</span>30</h4></div>
                            <h4 class="fw-700 text-grey-900 font-xssss mt-2">Developer Programe <span class="d-block font-xsssss fw-500 mt-1 lh-4 text-grey-500">41 madison ave, floor 24 new work, NY 10010</span> </h4>
                        </div>

                        <div class="card-body d-flex pt-0 ps-4 pe-4 pb-3 overflow-hidden">
                            <div class="bg-primary me-2 p-3 rounded-xxl"><h4 class="fw-700 font-lg ls-3 lh-1 text-white mb-0"><span class="ls-1 d-block font-xsss text-white fw-600">APR</span>23</h4></div>
                            <h4 class="fw-700 text-grey-900 font-xssss mt-2">Aniversary Event <span class="d-block font-xsssss fw-500 mt-1 lh-4 text-grey-500">41 madison ave, floor 24 new work, NY 10010</span> </h4>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
