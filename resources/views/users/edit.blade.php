<?php /** @var \App\Models\User $user; */?>

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Edit user</h1>
        </div>

        <form action="{{route('users.update', $user)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
            <div class="row">
                <div class="offset-1 col-4">

                    <div class="row mt-5">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name">User Name:</label>
                                <input type="text" name="name" id="name" class='form-control {{ ($errors->has('name') ? ' is-invalid' : '') }}' value="{{$user->name}}" required>
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
                                <label for="email">Email:</label>
                                <input type="text" name="email" id="email" class='form-control {{ ($errors->has('email') ? ' is-invalid' : '') }}' value="{{$user->email}}" required>
                                @if($errors->has('email'))
                                    <div class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if(Auth::user()->category->title !== \App\Models\Category::PATIENT_CATEGORY_TITLE)
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <select name="category_id" id="category" class="form-select">
                                        @foreach($categories as $id => $title)
                                            <option value="{{$id}}" {{ $user->category?->id == $id ? 'selected' : '' }}>{{$title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="roomName">Meetings room name:</label>
                                    <input type="text" name="roomName" id="roomName" class='form-control {{ ($errors->has('roomName') ? ' is-invalid' : '') }}' value="{{$user->roomName}}" required>
                                    @if($errors->has('roomName'))
                                        <div class="invalid-feedback">
                                            <strong>{{ $errors->first('roomName') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="password">{{ __('Password') }}:</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" autocomplete="new-password" name="password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="password-confirm">{{ __('Confirm Password') }}:</label>
                                <input id="password-confirm" type="password" class="form-control" autocomplete="new-password" name="password_confirmation">
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-12">
                            <input type="submit" class="btn w-100 btn-primary" value="Update User">
                        </div>
                    </div>

                </div>
            </div>
        </form>

    </div>
@endsection
