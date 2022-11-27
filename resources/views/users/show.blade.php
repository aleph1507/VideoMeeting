<?php /** @var \App\Models\User $user; */?>

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>{{$user->name}}</h1>
        </div>
        <div class="row">
            <div class="col-3">
                <a href="{{route('users.index')}}" class="btn btn-outline-dark">&laquo; Users index</a>
            </div>
        </div>

    </div>
@endsection
