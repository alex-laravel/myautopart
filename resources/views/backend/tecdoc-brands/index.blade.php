@extends('backend.layout.main')

@section('styles')
    <link href="{{ mix('/css/backend.datatable.css') }}" rel="stylesheet">
@endsection

@section('title', trans('labels.backend.brands.management'))

@section('header')
    <h1>
        <i class="far fa-building"></i>
        {{ trans('labels.backend.brands.management') }}
    </h1>
@endsection

@section('content')
    <div class="card card-accent-info mt-3">
        <div class="card-header">
            <h4 class="d-inline-block">{{ trans('labels.backend.brands.list') }}</h4>

            <div class="float-right">
                @include('backend.tecdoc-brands.partials.header-buttons')
            </div>
        </div>

        <div class="card-body">
            <table id="tecdoc-brands-table" class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>brandId</th>
                    <th>brandLogoID</th>
                    <th>brandName</th>
                </tr>
                </thead>
            </table>

            <strong class="d-block">NOTES:</strong>
            <small>??? articleCountry</small><br>
            <small>UA 910</small><br>
            <small>NL 910</small><br>
            <small>PL 910</small><br>
            <small>RU 910</small><br>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ mix('/js/backend.datatable.js') }}"></script>
    <script>
        $(function () {
            $('#tecdoc-brands-table').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 25,
                ajax: {
                    headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                    url: '{{ route('backend.ajax.brands.get') }}',
                    type: 'post'
                },
                columns: [
                    {data: 'id', name: 'td_brands.id'},
                    {data: 'brandId', name: 'td_brands.brandId'},
                    {data: 'brandLogoID', name: 'td_brands.brandLogoID'},
                    {data: 'brandName', name: 'td_brands.brandName'}
                ],
                order: [[0, "asc"]],
                searchDelay: 500
            });
        });
    </script>
@endsection

