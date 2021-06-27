@extends('backend.layout.main')

@section('styles')
    <link href="{{ mix('/css/backend.datatable.css') }}" rel="stylesheet">
@endsection

@section('title', trans('labels.backend.brand-addresses.management'))

@section('header')
    <h1>
        <i class="fas fa-tools"></i>
        {{ trans('labels.backend.brand-addresses.management') }}
    </h1>
@endsection

@section('content')
    <div class="card card-accent-info mt-3">
        <div class="card-header">
            <h4>{{ trans('labels.backend.brand-addresses.list') }}</h4>
        </div>

        <div class="card-body">
            <table id="tecdoc-brand-addresses-table" class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>addressName</th>
                    <th>addressType</th>
                    <th>city</th>
                    <th>fax</th>
                    <th>logoDocId</th>
                    <th>name</th>
                    <th>phone</th>
                    <th>street</th>
                    <th>wwwURL</th>
                    <th>zip</th>
                    <th>zipCountryCode</th>
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
            $('#tecdoc-brand-addresses-table').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 25,
                ajax: {
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    url: '{{ route('backend.ajax.brand-addresses.get') }}',
                    type: 'post'
                },
                columns: [
                    {data: 'id', name: 'td_brand_addresses.id'},
                    {data: 'addressName', name: 'td_brand_address.addressName'},
                    {data: 'addressType', name: 'td_brand_address.addressType'},
                    {data: 'city', name: 'td_brand_address.city'},
                    {data: 'fax', name: 'td_brand_address.fax'},
                    {data: 'logoDocId', name: 'td_brand_address.logoDocId'},
                    {data: 'name', name: 'td_brand_address.name'},
                    {data: 'phone', name: 'td_brand_address.phone'},
                    {data: 'street', name: 'td_brand_address.street'},
                    {data: 'wwwURL', name: 'td_brand_address.wwwURL'},
                    {data: 'zip', name: 'td_brand_address.zip'},
                    {data: 'zipCountryCode', name: 'td_brand_address.zipCountryCode'}
                ],
                order: [[0, "asc"]],
                searchDelay: 500
            });
        });
    </script>
@endsection
