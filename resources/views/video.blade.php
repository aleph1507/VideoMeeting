<?php /** @var string $banner; */ ?>

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 text-center">
            <div class="container">
                <div class="col-12">
                    <div id="meet"></div>
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

@section('footer-content')
    <script src='https://meet.jit.si/external_api.js'></script>
    <script>
        function jitsiInit()
        {
            const domain = 'jitsi.rx-doctors.info';
            const options = {
                roomName: '{{$roomName}}',
                width: 600,
                height: 600,
                parentNode: document.querySelector('#meet'),
                lang: 'en',
                userInfo: {
                    email: '{{auth()->user()->email}}',
                    displayName: '{{$displayName}}'
                }
            };
            const api = new JitsiMeetExternalAPI(domain, options);
        }

        window.onload = function() {
            jitsiInit();
        }
    </script>
@endsection
