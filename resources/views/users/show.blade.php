<?php /** @var \App\Models\User $user; */?>

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>{{$user->name}}</h1>
        </div>
        <div class="row">
            @can('admin_area')
                <div class="col-3">
                    <a href="{{route('users.index')}}" class="btn btn-outline-dark">&laquo; Users index</a>
                </div>
            @endcan
        </div>

        <div class="row mt-5">
            <div class="col-2 text-end">
                <span>Name:</span>
            </div>
            <div class="col-7">
                <span>{{$user->name}}</span>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-2 text-end">
                <span>Email:</span>
            </div>
            <div class="col-7">
                <span>{{$user->email}}</span>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-2 text-end">
                <span>Category:</span>
            </div>
            <div class="col-7">
                <span>{{$user->category->title}}</span>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-6 text-end">
                <a href="{{route('users.edit', $user)}}"
                    class="btn btn-warning w-75">
                    <i class="fa-solid fa-pen-to-square"></i> Edit User
                </a>
            </div>
            <div class="col-6">
                @if(!$user->isPrimaryAdmin())
                    <form action="{{route('users.destroy', $user)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger w-75">
                            <i class="fa-solid fa-trash"></i> Delete User
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
