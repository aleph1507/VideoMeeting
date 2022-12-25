<?php /** @var \App\Models\Banner $banner; */ ?>
<?php /** @var \App\Models\Stats $stats; */ ?>

@extends('layouts/app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Banner
                <a href="{{route('banners.show', $stats->banner?->id)}}">{{$stats->banner?->name}}</a>/{{$stats->date}}</h1>
        </div>

        <div class="row">
            <div class="col-10 offset-1">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th>Action</th>
                        <th>Consumer</th>
                        <th>URL</th>
                        <th>Meeting Host</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($params as $param)
                            <tr>
                                <td>{{$param['action'] === \App\Models\Stats::ACTION_CLICK ? 'Clicked' : 'Viewed'}}</td>
                                <td>
                                    @if(!$param['user'])
                                        {{\App\Models\Stats::NO_USER_MSG}}
                                    @else
                                        <a href="{{route('users.show', $param['user']->id)}}">{{$param['user']->name}}</a>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{$param['url']}}">{{$param['url']}}</a>
                                </td>
                                <td>
                                    @if(!$param['hostUser'])
                                        {{\App\Models\Stats::NO_USER_MSG}}
                                    @elseif($param['hostUser'] === \App\Models\Stats::NOT_AVAILABLE)
                                        {{\App\Models\Stats::NOT_AVAILABLE}}
                                    @else
                                        <a href="{{route('users.show', $param['hostUser']->id)}}">{{$param['hostUser']->name}}</a>
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
