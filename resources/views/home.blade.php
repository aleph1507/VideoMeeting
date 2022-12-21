<?php /** @var string $banner; */ ?>

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 text-center">
            <div class="container">
                <div class="col-12">
                    <img src="https://www.digitalserum.site/secured.gif" alt="Sample Image">
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-12 mt-5 text-center">
            {!! $banner !!}
        </div>
    </div>
</div>
@endsection
