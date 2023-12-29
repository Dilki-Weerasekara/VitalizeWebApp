<form wire:submit.prevent="createpost" class="pt-4 pb-3 mb-3 border-0 card w-100 shadow-xss rounded-xxl ps-4 pe-4">

    <?php
    $icons = new \Feather\IconManager();
    ?>

    <div class="card-body p-0">
        <a href="#" class=" font-xssss fw-600 text-grey-500 card-body p-0 d-flex align-items-center"><i class="btn-round-sm font-xs text-primary me-2 bg-greylight" style="margin-top: -10px">{!! $icons->getIcon('edit-3') !!}</i>Create Post</a>
    </div>
    <div class="card-body p-0 mt-3 position-relative">
        <figure class="avatar position-absolute ms-2 mt-1 top-5"><img
            src="{{ auth()->user()->profile ? asset('storage').'/'.auth()->user()->profile : 'images/user-8.png' }}" alt="image"
            class="shadow-sm rounded-circle w30"></figure>
        <textarea wire:model.lazy="content" name="content" required
            class="p-2 h100 bor-0 w-100 rounded-xxl ps-5 font-xssss text-grey-500 fw-500 border-light-md theme-dark-bg"
            cols="30" rows="10" placeholder="What's on your mind?"></textarea>
    </div>

    {{-- catch any error in the content using file uploads using laravel livewire component--}}
    @error('content')
        <span class="error">{{ $message }}</span>
    @enderror

    {{-- add the loading preview icons to images and videos --}}
    <div wire:loading wire:target="images">Uploading your pictures, please wait....</div>
    <div wire:loading wire:target="video">Uploading your videos, please wait....</div>


    @if ($images)
        @foreach ($images as $image)
            <img src="{{ $image->temporaryUrl() }}" alt="" width="width:100px">
        @endforeach
    @endif

    {{-- display one video at a time --}}
    @if ($video)
        <video src="{{ $video->temporaryUrl() }}" alt="" width="width:100%; height:100%"> </video>
            <br>
    @endif

    {{-- hide the image and video file choosen icons --}}
    <style>
        .upload-btn-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
        }

        .upload-btn-wrapper input[type=file] {
            font-size: 100px;
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
        }
    </style>

    <div class="p-0 mt-0 card-body d-flex">

        {{-- add image file icon to create post --}}
        <a href="#"
            class="d-flex align-items-center font-xssss fw-600 ls-1 text-success pe-4 upload-btn-wrapper"><i
                class="font-md text-success me-2">{!! $icons->getIcon('image') !!}</i><span class="d-none-xs">Photo
                <input type="file" multiple id="file" wire:model='images'></span></a>

         {{-- add video file icon to create post --}}
        <a href="#"
            class="d-flex align-items-center font-xssss fw-600 ls-1 text-danger  pe-4 upload-btn-wrapper"><i
                class="font-md text-danger me-2">{!! $icons->getIcon('video') !!}</i><span class="d-none-xs">Video
                <input type="file" id="file" wire:model='video'></span></a>

         {{-- add send icon to create post --}}
        <button style="outline: none;
                border: none;
                border-radius: 43px;" type="submit"
            class="outline-none ms-auto botder-none bg-none"><i
                class=" text-grey-900 btn-round-md bg-greylight font-xss">{!! $icons->getIcon('send') !!}</i></button>
    </div>

</form>
