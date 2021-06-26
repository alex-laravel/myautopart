@extends('backend.layout.main')

@section('title', trans('labels.backend.country-groups.management'))

@section('header')
    <h1>{{ trans('labels.backend.country-groups.management') }}</h1>
@endsection

@section('content')
    <div class="card card-accent-info mt-3">
        <div class="card-header">
            <h4>{{ trans('labels.backend.country-groups.list') }}</h4>
        </div>

        <div class="card-body"></div>
    </div>
@endsection
