<div class="main-content right-chat-active">
    @php
        $icons = new \Feather\IconManager();
    @endphp
    <div class="middle-sidebar-bottom">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
            integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
        </script>
        <div class="middle-sidebar-left">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="card w-100 border-0 p-0 rounded-3 overflow-hidden bg-image-contain bg-image-center"
                        style="background-image: url(images/help-bg.png);">
                        <div class="card-body p-md-5 p-4 text-center" style="background-color:rgba(0,85,255,0.8)">
                            <h2 class="fw-700 display2-size text-white display2-md-size lh-2">Welcome to the
                                {{ config('app.name') }} Community!</h2>
                            <p class="font-xsss ps-lg-5 pe-lg-5 lh-28 text-grey-200">Here provide information about areas of experties,contact details & availabilities. </p>

                        </div>
                    </div>
                    <div class="card w-100 border-0 shadow-none bg-transparent mt-5">
                        <div id="accordion" class="accordion mb-0">
                          <div class="card shadow-xss">
                            <div class="card-header" id="headingOne">
                              <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" style="color: blue">
                                    Psychology Today UK Directory
                                </button>
                              </h5>
                            </div>

                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                              <div class="card-body">
                                <p style="color: black">This is a comprehensive directory where you can find detailed listings for mental health professionals in the United Kingdom, including counselors, therapists, and psychologists. The directory allows filtering by location, services, or specializations</p> <a href="https://www.psychologytoday.com/gb/counselling">Psychology Today UK</a>
                              </div>
                            </div>
                          </div>
                          <div class="card shadow-xss">
                            <div class="card-header" id="headingTwo">
                              <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="color: blue">
                                    British Association for Counselling and Psychotherapy (BACP) Therapist Directory
                                </button>
                              </h5>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                              <div class="card-body">
                                <p style="color: black">BACP offers an online directory of around 16,000 private therapists. All therapists listed are registered or accredited BACP members, ensuring high standards for training, experience, and ethical practice. The directory allows searching by location, services, or specializations.</p> <a href="https://www.bacp.co.uk/">BACP</a>
                              </div>
                            </div>
                          </div>
                          <div class="card shadow-xss">
                            <div class="card-header" id="headingFour">
                              <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour" style="color: blue">
                                    RightTherapist.com
                                </button>
                              </h5>
                            </div>

                            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                              <div class="card-body">
                                <p style="color: black">This is an independent directory of therapists and counsellors in the UK. It offers a user-friendly way to filter therapists or counsellors by location, focus area, condition specializations, theoretical approach, mode of working, or accreditation status.</p>   <a href="https://righttherapist.com/">RightTherapist.com</a>
                            </div>
                          </div>
                          <div class="card shadow-xss">
                            <div class="card-header" id="headingFive">
                              <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive"  style="color: blue">
                                    Counselling Directory UK
                                </button>
                              </h5>
                            </div>

                            <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                              <div class="card-body">
                                <p  style="color: black">This platform connects individuals with skilled counsellors and therapists nearby. All therapists are verified professionals. It also provides information on common mental health concerns, treatment options, and how counselling may help.</p> <a href="https://www.counselling-directory.org.uk/">Counselling Directory UK</a>
                              </div>
                            </div>
                          </div>
                          <div class="card shadow-xss">
                            <div class="card-header" id="headingSix">
                              <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix" style="color: blue">
                                    NHS Support Groups for Depression
                                </button>
                              </h5>
                            </div>

                            <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
                              <div class="card-body">
                                <p style="color: black">The NHS website provides information about depression support groups in your area. It offers guidance on other types of depression support, such as online forums and pursuing interests.</p>   <a href="https://www.nhs.uk/">NHS</a>
                              </div>
                            </div>
                          </div>
                          <div class="card shadow-xss">
                            <div class="card-header" id="headingThree">
                              <h5 class="mb-0">
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"  style="color: blue">
                                    Mental Health UK Support Groups
                                </button>
                              </h5>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                              <div class="card-body">
                                <p style="color: black"> Mental Health UK provides support groups as a core part of their work. These groups offer spaces for members to come together to share experiences and information. The types of groups vary according to the needs of their local members, ranging from sport and leisure to gardening and cooking.</p>   <a href="https://mentalhealth-uk.org/">Mental Health UK </a>
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
