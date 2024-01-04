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
                            <h1 class="text-center mt-2">Guided Self-Help Programs for Mindful Living</h1>
                            <br>

                            {{-- Dropdown --}}
                            <div class="dropdown-center d-flex justify-content-center">
                                <button class="btn btn-warning dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Select your Favourite Category...
                                </button>
                                <ul class="dropdown-menu ">
                                  <li><a class="dropdown-item" href="/user_cognitive_exercises">Cognitive Behavioral Therapy Exercises</a></li>
                                  <li><a class="dropdown-item" href="/user_mindfulness_practices">Mindfulness Practices</a></li>
                                  <li><a class="dropdown-item" href="#">Relaxation Techniques</a></li>
                                  <li><a class="dropdown-item" href="/user_good_practices">Good Practices to Relieve Stress</a></li>
                                </ul>
                            </div>

                            {{-- Grid cards for Categories --}}
                            <div class="row row-cols-1 row-cols-md-2 g-4 mt-3 mb-4">
                                <div class="col">
                                  <div class="card h-100">
                                    <img src="{{ URL('images/cbt_therapy.jpg') }}" class="card-img-top" alt="...">
                                    <div class="card-body grid-card-self_help ">
                                      <p class="card-title d-flex justify-content-center">Cognitive Behavioral Therapy Exercises</p>
                                    </div>
                                    <div class="card-footer ">
                                            <a class="btn btn-warning col-12" href="/user_cognitive_exercises" role="button">Click Here to Explore More...</a>
                                    </div>
                                  </div>
                                </div>

                                <div class="col">
                                    <div class="card h-100">
                                      <img src="{{ URL('images/mindfulness.png') }}" class="card-img-top" alt="...">
                                      <div class="card-body grid-card-self_help ">
                                        <p class="card-title d-flex justify-content-center">Mindfulness Practices</p>
                                      </div>
                                      <div class="card-footer ">
                                              <a class="btn btn-warning col-12" href="/user_mindfulness_practices" role="button">Click Here to Explore More...</a>
                                      </div>
                                    </div>
                                  </div>

                                <div class="col">
                                    <div class="card h-100">
                                      <img src="{{ URL('images/relaxation.jpg') }}" class="card-img-top" alt="...">
                                      <div class="card-body grid-card-self_help ">
                                        <p class="card-title d-flex justify-content-center">Awareness Programs</p>
                                      </div>
                                      <div class="card-footer ">
                                            <a class="btn btn-warning col-12" href="/user_select_awareness" role="button">Click Here to Explore More...</a>
                                      </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="card h-100">
                                      <img src="{{ URL('images/Good Practices.png') }}" class="card-img-top" alt="...">
                                      <div class="card-body grid-card-self_help">
                                        <p class="card-title d-flex justify-content-center">Good Practices to Relieve Stress </p>
                                      </div>
                                      <div class="card-footer ">
                                        <a class="btn btn-warning col-12" href="/user_good_practices" role="button">Click Here to Explore More...</a>
                                      </div>
                                    </div>
                                </div>
                            </div>

                             {{-- Pagination section --}}
                             <nav aria-label="Pagination">
                                <ul class="pagination justify-content-center  mt-5 mb-3">
                                    <li class="page-item disabled"><a href="" class="page-link">Previous</a></li>
                                    <li class="page-item active"><a href="" class="page-link">1</a></li>
                                    <li class="page-item disabled"><a href="" class="page-link">2</a></li>
                                    <li class="page-item  disabled"><a href="" class="page-link">3</a></li>
                                    <li class="page-item  disabled"><a href="" class="page-link">Next</a></li>
                                </ul>
                            </nav>


                        </div>

                     </div>
                </div>
            </div>

        </div>
    </div>
</div>

