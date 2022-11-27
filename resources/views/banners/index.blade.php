<?php /** @var \App\Models\Banner[] $banners; */ ?>

@extends('layouts/app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Banners</h1>
        </div>

        <div class="row">
            <div class="col-2 offset-9 text-end">
                <a href="{{route('banners.create')}}" class="btn btn-primary">
                    Create Banner
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-10 offset-1">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Media Type</th>
                        <th>File Name</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($banners as $banner)
                        <tr>
                            <td>
                                <a href="{{route('banners.show', $banner)}}">{{$banner->id}}</a>
                            </td>
                            <td>{{$banner->name}}</td>
                            <td>{{$banner->file_type}}</td>
                            <td>{{$banner->original_name}}</td>
                            <td>
                                <a href="{{route('banners.show', $banner)}}" class="btn btn-primary btn-sm">
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                <a href="{{route('banners.edit', $banner)}}" class="btn btn-warning btn-sm">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>

                                <form action="{{route('banners.destroy', $banner)}}" class="d-inline" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
