@extends('frontend.layout.main')

@section('title', trans('menus.frontend.checkout.title'))

@section('content')
    <div class="site__body">
        <div class="block-space block-space--layout--spaceship-ledge-height"></div>
        <div class="block">
            <div class="container">
                <div class="document">
                    <div class="document__header">
                        <h1 class="document__title">
                            {{ trans('pages.frontend.checkout.title') }}
                        </h1>
                    </div>

                    <div class="document__content card">




                    </div>
                </div>
            </div>
        </div>
        <div class="block-space block-space--layout--before-footer"></div>
    </div>
@endsection
