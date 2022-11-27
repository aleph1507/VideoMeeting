<?php /** @var \App\Models\Category $category ; */ ?>

@extends('layouts/app')

@section('content')

    <div class="container">
        <div class="row">
            <h1>Edit category {{$category->title}}</h1>
        </div>
        <div class="row">
            <div class="col-3">
                <a href="{{route('categories.index')}}" class="btn btn-outline-dark">&laquo; Categories index</a>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <form action="{{route('categories.update', $category)}}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-2 offset-1">
                            <label for="title">Title:</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-5 offset-1 pe-0">
                            <input type="text" name="title" class='form-control {{ ($errors->has('title') ? ' is-invalid' : '') }}' value="{{$category->title}}" required>
                            @if($errors->has('title'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="col-2 ps-0">
                            <input type="submit" class="btn w-100 btn-primary" value="Update Category">
                        </div>
                    </div>
                </form>

                <div class="row mt-3">
                    <div class="col-2 offset-6 ps-0">
                        <form action="{{route('categories.destroy', $category)}}" method="post">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger w-100">
                                <i class="fa-solid fa-trash"></i> Delete Category
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
