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
                                {{-- <figure class="avatar me-3"><img src="{{ $post->user->profile ? asset('storage') . '/' . $post->user->profile : 'images/user-7.png' }}" alt="image" class="shadow-sm rounded-circle w45"></figure>
                                <h4 class="fw-700 text-grey-900 font-xssss mt-1">{{ $post->user->username }} <span class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">{{ $post->created_at->diffForHumans() }}</span></h4> --}}

                                <figure class="avatar me-3"><img
                                    src="{{ asset('storage') . '/' . $post->user->profile ?? 'images/user-7.png' }}"
                                    alt="image" class="shadow-sm rounded-circle w45"></figure>
                                <h4 class="mt-1 fw-700 text-grey-900 font-xssss"> <a
                                    href="{{ route('user', $post->user->uuid) }}">{{ $post->user->username }}</a>
                                @if ($post->is_group_post)
                                    posted on <a
                                        href="{{ route('group', $post->group->uuid) }}">{{ $post->group->name }}</a>
                                @endif
                                @if ($post->is_page_post)
                                    posted on <a
                                        href="{{ route('page', $post->page->uuid) }}">{{ $post->page->name }}</a>
                                @endif <span
                                    class="mt-1 d-block font-xssss fw-500 lh-3 text-grey-500">{{ $post->created_at->diffForHumans() }}</span>

                                </h4>

                                <a href="#" class="ms-auto" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti-more-alt text-grey-900 btn-round-md bg-greylight font-xss"></i></a>

                                <div class="dropdown-menu dropdown-menu-end p-4 rounded-xxl border-0 shadow-lg" aria-labelledby="dropdownMenu2">
                                    <div class="card-body p-0 d-flex" style="cursor: pointer"
                                    wire:click="save({{ $post->id }})">
                                        <i class=" text-grey-500 me-3 font-lg" style="margin-top: -10px">{!! $icons->getIcon('bookmark') !!}</i>
                                        <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4">Save Link <span class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Add this to your saved items</span></h4>
                                    </div>

                                    {{-- Start the hide all from section --}}

                                    {{-- Hide group posts section --}}
                                    @if ($post->is_group_post)
                                    <div wire:click="hide_all_from('group',{{ $post->group->id }})"
                                        class="p-0 mt-2 card-body d-flex" style="cursor: pointer">
                                        <i class=" text-grey-500 me-3 font-lg"
                                            style="margin-top: -10px">{!! $icons->getIcon('alert-octagon') !!}</i>
                                        <h4 class="mt-0 fw-600 text-grey-900 font-xssss me-4">Hide all posts of this
                                            {{ $post->group->name }}
                                            <span class="mt-1 d-block font-xsssss fw-500 lh-3 text-grey-500">Remove from your wall</span>
                                        </h4>
                                    </div>

                                    {{-- Hide page posts section --}}
                                @elseif ($post->is_page_post)
                                    <div wire:click="hide_all_from('page',{{ $post->page->id }})"
                                        class="p-0 mt-2 card-body d-flex" style="cursor: pointer">
                                        <i class=" text-grey-500 me-3 font-lg"
                                            style="margin-top: -10px">{!! $icons->getIcon('alert-octagon') !!}</i>
                                        <h4 class="mt-0 fw-600 text-grey-900 font-xssss me-4">Hide all posts of this
                                            {{ $post->page->name }}
                                            <span class="mt-1 d-block font-xsssss fw-500 lh-3 text-grey-500">Remove from your wall</span>
                                        </h4>
                                    </div>
                                @else
                                    {{-- Hide the friends posts --}}
                                    <div wire:click="hide_all_from('user',{{ $post->user->id }})"
                                        class="p-0 mt-2 card-body d-flex" style="cursor: pointer">
                                        <i class=" text-grey-500 me-3 font-lg"
                                            style="margin-top: -10px">{!! $icons->getIcon('alert-octagon') !!}</i>
                                        <h4 class="mt-0 fw-600 text-grey-900 font-xssss me-4">Hide all posts of this
                                            {{ $post->user->username }}
                                            <span class="mt-1 d-block font-xsssss fw-500 lh-3 text-grey-500">Remove from your wall</span>
                                        </h4>
                                    </div>
                                @endif
                                {{-- End of the hide all from section --}}
                                </div>
                            </div>


                            <div class="card-body p-0 me-lg-5">
                                <a
                                    href="{{ route('single-post', ['useruuid' => $post->user->uuid, 'postuuid' => $post->uuid]) }}">
                                    <p class="fw-500 text-grey-900 lh-26 font-xssss w-100">{{ $post->content }}</p>

                                    {{-- view the wallpost as singlePost in another page --}}
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
                                    class="p-2 border-0 bg-grey text-grey-900 font-xssss lh-32 fw-600 rounded-3 w-100 theme-dark-bg"
                                    id="">
                            </form>
                        </div>

                    @empty
                        <h1 class="text-center text-danger"> No New Posts Found !!</h1>
                    @endforelse


                    {{-- dot typing end of the page --}}
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
                        <div class="card-body d-flex align-items-center  p-4">
                            <h4 class="fw-700 mb-0 font-xssss text-grey-900">Crisis Helplines and Hotlines</h4>
                            <a href="default-event.html" class="fw-600 ms-auto font-xssss text-primary">See all</a>
                        </div>

                        <div class="card border-danger mb-3 ms-3 me-3">
                            <div class="card-header d-flex justify-content-center"><h2>24/7 Support</h2></div>
                            <div class="card-body text-danger">
                              <h5 class="card-title">Samaritans</h5>
                              <p class="card-text">Call 116 123 <br> Email jo@samaritans.org </p>
                              <h5 class="card-title">Shout</h5>
                              <p>Text 'SHOUT' to 85258 for confidential and anonymous support.</p>
                            </div>
                        </div>

                        <div class="card border-danger mb-3 ms-3 me-3">
                            <div class="card-header d-flex justify-content-center"><h2>Suicide Prevention</h2></div>
                            <div class="card-body text-danger">
                              <h5 class="card-title">National Suicide Prevention Helpline UK</h5>
                              <p class="card-text">Call 0800 689 5652 </p>
                              <h5 class="card-title">Papyrus HOPELINEUK</h5>
                              <p>0800 068 4141, email pat@papyrus-uk.org, or text 07786 209 697</p>
                            </div>
                        </div>

                        <div class="card border-danger mb-3 ms-3 me-3">
                            <div class="card-header d-flex justify-content-center"><h2>Mental Health Support</h2></div>
                            <div class="card-body text-danger">
                              <h5 class="card-title">SANEline</h5>
                              <p class="card-text"> Available from 4.30pm to 10.30pm every day at 0300 304 7000.</p>
                              <h5 class="card-title">Campaign Against Living Miserably (CALM)</h5>
                              <p>Available from 5pm to midnight every day at 0800 58 58 58</p>
                            </div>
                        </div>


                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
