<?php /** @var \App\Models\User[] $users; */ ?>

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Users</h1>
        </div>

        <div class="row">
            <div class="col-10 offset-1">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Category</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    <a href="{{route('users.show', $user)}}">{{$user->id}}</a>
                                </td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    @if(isset($user->category))
                                        <a href="{{route('categories.edit', $user->category)}}">{{$user->category?->title}}</a>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="{{route('users.show', $user)}}" class="btn btn-primary btn-sm">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>

                                    <a href="{{route('users.edit', $user)}}" class="btn btn-warning btn-sm">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>

                                    @if(strtolower($user->category?->title) !== strtolower(\App\Models\Category::ADMINISTRATOR_CATEGORY_TITLE))
                                        <form action="{{route('users.destroy', $user)}}" class="d-inline" method="post">
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

    </div>
@endsection
