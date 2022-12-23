<?php /** @var \App\Models\Category[] $categories; */?>

@extends('layouts/app')

@section('content')

    <div class="container">
        <div class="row">
            <h1>Categories</h1>
        </div>

        <form action="{{route('categories.store')}}" method="post">
            @csrf
            <div class="row">
                <div class="d-flex">
                    <div class="col-3 offset-6 text-end pe-0">
                        <input type="text" name="title" placeholder="New category title" class='form-control {{ ($errors->has('title') ? ' is-invalid' : '') }}' value="{{old('title')}}">
                    </div>
                    <div class="col-3 text-start ps-0">
                        <input type="submit" class="btn btn-primary" value="Create Category">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    @if($errors->has('title'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('title') }}</strong>
                        </div>
                    @endif
                </div>
            </div>
        </form>

        <div class="row">
            <div class="col-10 offset-1">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>
                                <a href="{{route('categories.edit', $category)}}">{{$category->id}}</a>
                            </td>
                            <td>{{$category->title}}</td>
                            <td class="text-end">
                                @if(strtolower($category->title) !== strtolower(\App\Models\Category::ADMINISTRATOR_CATEGORY_TITLE) || strtolower($category->title) !== strtolower(\App\Models\Category::PATIENT_CATEGORY_TITLE))
                                    <a href="{{route('categories.edit', $category)}}" class="btn btn-warning btn-sm">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>

                                    <form action="{{route('categories.destroy', $category)}}" class="d-inline" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-10 offset-1">
                {{$categories->links()}}
            </div>
        </div>
    </div>

@endsection
