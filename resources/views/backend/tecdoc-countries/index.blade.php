@extends('backend.layout.main')

@section('title', trans('labels.backend.countries.management'))

@section('header')
    <h1>
        <i class="far fa-flag"></i>
        {{ trans('labels.backend.countries.management') }}
    </h1>
@endsection

@section('content')
    <div class="card card-accent-info mt-3">
        <div class="card-header">
            <h4>{{ trans('labels.backend.countries.list') }}</h4>
        </div>

        <div class="card-body"></div>
    </div>
@endsection
