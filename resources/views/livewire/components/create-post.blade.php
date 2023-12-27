<div class="card w-100 shadow-xss rounded-xxl border-0 ps-4 pt-4 pe-4 pb-3 mb-3">

    <?php
    $icons = new \Feather\IconManager();
    ?>

    <div class="card-body p-0">
        <a href="#" class=" font-xssss fw-600 text-grey-500 card-body p-0 d-flex align-items-center"><i class="btn-round-sm font-xs text-primary me-2 bg-greylight" style="margin-top: -10px">{!! $icons->getIcon('edit-3') !!}</i>Create Post</a>
    </div>
    <div class="card-body p-0 mt-3 position-relative">
        <figure class="avatar position-absolute ms-2 mt-1 top-5"><img
            src="{{ auth()->user()->profile ? asset("storage").'/'.auth()->user()->profile : 'images/user-8.png' }}" alt="image"
            class="shadow-sm rounded-circle w30"></figure>
        <textarea name="message" class="h100 bor-0 w-100 rounded-xxl p-2 ps-5 font-xssss text-grey-500 fw-500 border-light-md theme-dark-bg" cols="30" rows="10" placeholder="What's on your mind?"></textarea>
    </div>
    <div class="card-body d-flex p-0 mt-0">
        <a href="#" class="d-flex align-items-center font-xssss fw-600 ls-1 text-grey-700 text-dark pe-4"><i class="font-md text-danger me-2" style="margin-top: -10px">{!! $icons->getIcon('video') !!}</i><span class="d-none-xs">Video</span></a>
        <a href="#" class="d-flex align-items-center font-xssss fw-600 ls-1 text-grey-700 text-dark pe-4"><i class="font-md text-success me-2" style="margin-top: -10px">{!! $icons->getIcon('image') !!}</i><span class="d-none-xs">Photo</span></a>

    </div>
</div>
