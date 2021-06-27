@extends('backend.layout.main')

@section('title', trans('labels.backend.brands.management'))

@section('header')
    <h1>
        <i class="fas fa-tools"></i>
        {{ trans('labels.backend.brands.management') }}
    </h1>
@endsection

@section('content')
    <div class="card card-accent-info mt-3">
        <div class="card-header">
            <h4>{{ trans('labels.backend.brands.list') }}</h4>
        </div>

        <div class="card-body"></div>
    </div>
@endsection
