<?php /** @var \App\Models\Banner $banner; */ ?>

@extends('layouts/app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>{{$banner->name}}</h1>
        </div>
        <div class="row">
            <div class="col-3">
                <a href="{{route('banners.index')}}" class="btn btn-outline-dark">&laquo; Banners index</a>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-2 text-end">
                <span>URL:</span>
            </div>
            <div class="col-7">
                <a href="{{$banner->url}}">{{$banner->url}}</a>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-2 text-end">
                <span>Name:</span>
            </div>
            <div class="col-7">
                <span>{{$banner->name}}</span>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-2 text-end">
                <span>Media Type:</span>
            </div>
            <div class="col-7">
                <span>{{$banner->file_type}}</span>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-2 text-end">
                <span>File Name:</span>
            </div>
            <div class="col-7">
                <span>{{$banner->original_name}}</span>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-4 text-end">
                <div class="row">
                    <div class="col-12">
                        <a href="{{route('banners.index')}}"
                            class="btn btn-primary w-75">
                                <i class="fa-solid fa-list"></i> Banners index
                        </a>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-12">
                        <a href="{{route('banners.edit', $banner)}}"
                            class="btn btn-warning w-75">
                                <i class="fa-solid fa-pen-to-square"></i> Edit Banner
                        </a>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-12">
                        <form action="{{route('banners.destroy', $banner)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-75">
                                <i class="fa-solid fa-trash"></i> Delete Banner
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-4 offset-1">
                @if ($banner->file_type === \App\Models\Banner::IMAGE_FILE_TYPE)
                    <img src="{{asset($banner->storage_path)}}" class="w-100" alt="{{$banner->name}}">
                @else
                    <video controls class="w-100">
                        <source src="{{asset($banner->storage_path)}}">
                        Your browser does not support the video tag.
                    </video>
                @endif
            </div>
        </div>
    </div>
@endsection
