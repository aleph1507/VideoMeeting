<?php /** @var \App\Models\Banner $banner; */ ?>

@extends('layouts/app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Update Banner {{$banner->name}}</h1>
        </div>
        <div class="row">
            <div class="col-3">
                <a href="{{route('banners.index')}}" class="btn btn-outline-dark">&laquo; Banners index</a>
            </div>
        </div>

        <form action="{{route('banners.update', $banner)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="offset-1 col-4">
                    <div class="row mt-5">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name">Banner Name:</label>
                                <input type="text" name="name" class='form-control {{ ($errors->has('name') ? ' is-invalid' : '') }}' value="{{$banner->name}}" required>
                                @if($errors->has('name'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="url">Banner URL:</label>
                                <input type="text" name="url" class='form-control {{ ($errors->has('url') ? ' is-invalid' : '') }}' value="{{$banner->url}}" required>
                                @if($errors->has('url'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="media">Banner Media:</label>
                                <input type="file" name="media"
                                    class='form-control {{ ($errors->has('media') ? ' is-invalid' : '') }}'
                                    accept="image/*, video/*"
                                    id="media-input">
                                    @if($errors->has('media'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('media') }}</strong>
                                        </div>
                                    @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-5 mt-5">
                    <div id="display-image" style="background-image: url('{{asset($banner->storage_path)}}')" class="{{$banner->file_type === \App\Models\Banner::IMAGE_FILE_TYPE ? '' : 'd-none'}}"></div>
                    <video controls id="video-tag" class="{{$banner->file_type === \App\Models\Banner::VIDEO_FILE_TYPE ? '' : 'd-none'}}">
                        <source id="video-source" src="{{asset($banner->storage_path)}}">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>

            <input type="hidden" name="media_type" id="media-type" value="{{$banner->file_type}}">

            <div class="row mt-5">
                <div class="offset-1 col-4">
                    <input type="submit" class="btn w-100 btn-primary" value="Update Banner">
                </div>
            </div>
        </form>
    </div>
@endsection

@section('footer-content')
    <script>
        const isImage = (file) => file['type'].includes('image');

        document.addEventListener('DOMContentLoaded', function () {
            const media_input = document.querySelector("#media-input");
            const display_image = document.querySelector("#display-image");
            const videoTag = document.getElementById('video-tag');
            const videoSrc = document.getElementById("video-source");
            const mediaType = document.getElementById('media-type');

            media_input.addEventListener("change", function() {
                const reader = new FileReader();
                reader.addEventListener("load", () => {
                    const uploaded_media = reader.result;
                    if (isImage(this.files[0])) {
                        mediaType.value = 'image';
                        if (!videoTag.classList.contains('d-none')) {
                            videoTag.classList.add('d-none');
                        }
                        display_image.classList.remove('d-none');
                        display_image.style.backgroundImage = `url(${uploaded_media})`;
                    } else {
                        mediaType.value = 'video';
                        if (!display_image.classList.contains('d-none')) {
                            display_image.classList.add('d-none');
                        }
                        videoTag.classList.remove('d-none');
                        videoSrc.src = reader.result;
                        videoTag.load();
                    }
                });
                reader.readAsDataURL(this.files[0]);
            });

            // media_input.addEventListener("change", function() {
            //     if (isImage(this.files[0])) {
            //         const reader = new FileReader();
            //         reader.addEventListener("load", () => {
            //             const uploaded_image = reader.result;
            //             if (!videoTag.classList.contains('d-none')) {
            //                 videoTag.classList.add('d-none');
            //             }
            //             display_image.classList.remove('d-none');
            //             display_image.style.backgroundImage = `url(${uploaded_image})`;
            //         });
            //         reader.readAsDataURL(this.files[0]);
            //     } else {
            //
            //     }
            // });
        });
    </script>
@endsection
