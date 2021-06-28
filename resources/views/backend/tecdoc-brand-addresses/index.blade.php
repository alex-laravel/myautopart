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
            <h4 class="d-inline-block">{{ trans('labels.backend.brand-addresses.list') }}</h4>

            <div class="float-right">
                @include('backend.tecdoc-brand-addresses.partials.header-buttons')
            </div>
        </div>

        <div class="card-body">
            <table id="tecdoc-brand-addresses-table" class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>brandId</th>
                    <th>addressName</th>
                    <th>addressType</th>
                    <th>city</th>
{{--                    <th>city2</th>--}}
                    <th>email</th>
{{--                    <th>fax</th>--}}
                    <th>logoDocId</th>
                    <th>mailbox</th>
                    <th>name</th>
{{--                    <th>name2</th>--}}
                    <th>phone</th>
{{--                    <th>street</th>--}}
{{--                    <th>street2</th>--}}
                    <th>wwwURL</th>
{{--                    <th>zip</th>--}}
{{--                    <th>zipCountryCode</th>--}}
{{--                    <th>zipMailbox</th>--}}
{{--                    <th>zipSpecial</th>--}}
                </tr>
                </thead>
            </table>

            <strong class="d-block">NOTES:</strong>
            <small>??? articleCountry</small><br>
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
                    {data: 'brandId', name: 'td_brand_address.brandId'},
                    {data: 'addressName', name: 'td_brand_address.addressName'},
                    {data: 'addressType', name: 'td_brand_address.addressType'},
                    {data: 'city', name: 'td_brand_address.city'},
                    // {data: 'city2', name: 'td_brand_address.city2'},
                    {data: 'email', name: 'td_brand_address.email'},
                    // {data: 'fax', name: 'td_brand_address.fax'},
                    {data: 'logoDocId', name: 'td_brand_address.logoDocId'},
                    {data: 'mailbox', name: 'td_brand_address.mailbox'},
                    {data: 'name', name: 'td_brand_address.name'},
                    // {data: 'name2', name: 'td_brand_address.name2'},
                    {data: 'phone', name: 'td_brand_address.phone'},
                    // {data: 'street', name: 'td_brand_address.street'},
                    // {data: 'street2', name: 'td_brand_address.street2'},
                    {data: 'wwwURL', name: 'td_brand_address.wwwURL'}
                    // {data: 'zip', name: 'td_brand_address.zip'},
                    // {data: 'zipCountryCode', name: 'td_brand_address.zipCountryCode'},
                    // {data: 'zipMailbox', name: 'td_brand_address.zipMailbox'},
                    // {data: 'zipSpecial', name: 'td_brand_address.zipSpecial'}
                ],
                order: [[0, "asc"]],
                searchDelay: 500
            });
        });
    </script>
@endsection
