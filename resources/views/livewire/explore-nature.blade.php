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
                            <h1 class="text-center mt-2">Discover a Diverse Collection of Nature Videos</h1>
                                <br>

                                {{-- Dropdown --}}
                                <div class="dropdown d-flex justify-content-center">
                                    <button class="btn btn-warning dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Select your Favourite Category...
                                    </button>
                                    <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('user_select_rainfall')}}">Rainfall Serenity</a></li>
                                    <li><a class="dropdown-item" href="{{ route('user_select_garden&blossoms') }}">Gardens and Blooms</a></li>
                                    <li><a class="dropdown-item" href="{{ route('user_select_waterfalls') }}">Waterfalls</a></li>
                                    <li><a class="dropdown-item" href="{{ route('user_select_skystars') }}">Sky and Stars</a></li>
                                    <li><a class="dropdown-item" href="/user_select_seaside">Seaside Tranquility</a></li>
                                    <li><a class="dropdown-item" href="/user_select_forest">Enchanted Forest</a></li>
                                    <li><a class="dropdown-item" href="/user_select_animals">Wildlife and Animals</a></li>
                                    <li><a class="dropdown-item" href="/user_select_lakes">Lakes and Ponds</a></li>
                                    </ul>
                                </div>

                                {{-- Grid cards for Categories --}}
                                <div class="row row-cols-1 row-cols-md-2 g-4 mt-3 mb-4">
                                    <div class="col">
                                    <div class="card h-100">
                                        <img src="{{ URL('images/rain.jpg') }}" class="card-img-top" alt="...">
                                        <div class="card-body grid-card-font ">
                                        <p class="card-title d-flex justify-content-center">Rainfall Serenity</p>
                                        </div>
                                        <div class="card-footer ">
                                            <a class="btn btn-dark col-12" role="button" href="{{ route('user_select_rainfall') }}">Click Here to Explore More...</a>
                                        </div>
                                    </div>
                                    </div>

                                    <div class="col">
                                        <div class="card h-100">
                                        <img src="{{ URL('images/flowers.jpg') }}" class="card-img-top" alt="...">
                                        <div class="card-body grid-card-font ">
                                            <p class="card-title d-flex justify-content-center">Gardens and Blooms</p>
                                        </div>
                                        <div class="card-footer ">
                                                <a   class="btn btn-dark col-12"  role="button" href="{{ route('user_select_garden&blossoms') }}">Click Here to Explore More...</a>
                                        </div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="card h-100">
                                        <img src="{{ URL('images/waterfall.jpg') }}" class="card-img-top" alt="...">
                                        <div class="card-body grid-card-font ">
                                            <p class="card-title d-flex justify-content-center">Waterfalls</p>
                                        </div>
                                        <div class="card-footer ">
                                                <a  class="btn btn-dark col-12" role="button" href="{{ route('user_select_waterfalls') }}"> Click Here to Explore More...</a>
                                        </div>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="card h-100">
                                        <img src="{{ URL('images/sky.jpg') }}" class="card-img-top" alt="...">
                                        <div class="card-body grid-card-font ">
                                            <p class="card-title d-flex justify-content-center">Sky and Stars</p>
                                        </div>
                                        <div class="card-footer ">
                                                <a  class="btn btn-dark col-12" role="button" href="{{ route('user_select_skystars')}}"> Click Here to Explore More...</a>
                                        </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Pagination section --}}
                                <nav aria-label="Pagination">
                                    <ul class="pagination justify-content-center  mt-5 mb-3">
                                        <li class="page-item disabled"><a href="" class="page-link">Previous</a></li>
                                        <li class="page-item active"><a href="/user_select_nature" class="page-link">1</a></li>
                                        <li class="page-item"><a href="/user_select_nature2" class="page-link">2</a></li>
                                        <li class="page-item"><a href="/user_select_nature2" class="page-link">Next</a></li>
                                    </ul>
                                </nav>

                        </div>

                    </div>




                </div>



            </div>


        </div>
    </div>
</div>


