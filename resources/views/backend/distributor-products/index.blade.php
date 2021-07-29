@extends('backend.layout.main')

@section('styles')
    <link href="{{ mix('/css/backend.datatable.css') }}" rel="stylesheet">
@endsection

@section('title', trans('labels.backend.distributor-products.management'))

@section('header')
    <h1>
        <i class="fas fa-warehouse"></i>
        {{ trans('labels.backend.distributor-products.management') }}
    </h1>
@endsection

@section('content')
    {{ Form::open(['route' => 'backend.distributor-products.import', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'POST', 'files'=> true]) }}
    <div class="card card-accent-danger mt-3">
        <div class="card-header">
            <h4 class="d-inline-block">{{ trans('labels.general.synchronize') }}</h4>

            <div class="float-right">
                <button class="btn btn-block btn-primary" type="submit">{{ trans('buttons.general.import') }}</button>
            </div>
        </div>

        <div class="card-body">
            <div class="form-group row">
                {{ Form::label('distributor_id', trans('menus.backend.shop.distributors.title'), ['class' => 'col-lg-2 control-label']) }}

                <div class="col-lg-5">
                    {{ Form::select('distributor_id', $distributorsList, false, ['class' => 'form-control', 'required' => 'required']) }}
                </div>

                <div class="col-lg-5">
                    {!! Form::file('distributor_file') !!}
                </div>
            </div>
        </div>
    </div>
    {{ Form::close() }}

    <div class="card card-accent-info mt-3">
        <div class="card-header">
            <h4 class="d-inline-block">{{ trans('labels.backend.distributor-products.list') }}</h4>

            <div class="float-right">
                @include('backend.distributor-products.partials.header-buttons')
            </div>
        </div>

        <div class="card-body">
            <table id="shop-distributor-products-table" class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>{{ trans('labels.backend.distributor-products.table.id') }}</th>
                    <th>{{ trans('labels.backend.distributor-products.table.original_product_no') }}</th>
                    <th>{{ trans('labels.backend.distributor-products.table.original_product_name') }}</th>
                    <th>{{ trans('labels.backend.distributor-products.table.original_brand_name') }}</th>
                    <th>{{ trans('labels.backend.distributor-products.table.price') }}</th>
                    <th>{{ trans('labels.backend.distributor-products.table.quantity') }}</th>
{{--                    <th>{{ trans('labels.general.actions') }}</th>--}}
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ mix('/js/backend.datatable.js') }}"></script>
    <script>
        $(function () {
            $('#shop-distributor-products-table').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 25,
                ajax: {
                    headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                    url: '{{ route('backend.ajax.distributor-products.get') }}',
                    type: 'post'
                },
                columns: [
                    {data: 'id', name: 'sh_distributor_products.id'},
                    {data: 'original_product_no', name: 'sh_distributor_products.original_product_no'},
                    {data: 'original_product_name', name: 'sh_distributor_products.original_product_name'},
                    {data: 'original_brand_name', name: 'sh_distributor_products.original_brand_name'},
                    {data: 'price', name: 'sh_distributor_products.price'},
                    {data: 'quantity', name: 'sh_distributor_products.quantity'}
                    // {data: 'actions', name: 'actions', searchable: false, sortable: false, 'class': 'text-nowrap'}
                ],
                order: [[0, 'asc']],
                searchDelay: 500
            });
        });
    </script>
@endsection
