@extends('marketing::layouts.app')

@section('title', __('Crawler'))

@section('heading')
    {{ __('Crawler') }}
@endsection

@section('content')

    @component('marketing::layouts.partials.actions')
        @slot('right')
            <a class="btn btn-primary btn-md btn-flat" href="{{ route('crawler.create') }}">
                <i class="fa fa-plus mr-1"></i> {{ __('New Crawler') }}
            </a>
        @endslot
    @endcomponent


@endsection
