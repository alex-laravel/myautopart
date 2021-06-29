@extends('backend.layout.main')

@section('styles')
    <link href="{{ mix('/css/backend.datatable.css') }}" rel="stylesheet">
@endsection

@section('title', trans('labels.backend.manufacturers.management'))

@section('header')
    <h1>
        <i class="fas fa-car"></i>
        {{ trans('labels.backend.manufacturers.management') }}
    </h1>
@endsection

@section('content')
    <div class="card card-accent-info mt-3">
        <div class="card-header">
            <h4 class="d-inline-block">{{ trans('labels.backend.manufacturers.list') }}</h4>

            <div class="float-right">
                @include('backend.tecdoc-manufacturers.partials.header-buttons')
            </div>
        </div>

        <div class="card-body">
            <table id="tecdoc-manufacturers-table" class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>slug</th>
                    <th>manuId</th>
                    <th>manuName</th>
                    <th>linkingTargetTypes</th>
                    <th>favorFlag</th>
                    <th>isPopular</th>
                    <th>isVisible</th>
                </tr>
                </thead>
            </table>

            <strong class="d-block">NOTES:</strong>
            <small>??? linkingTargetType - P|O|PO</small><br>
            <small>??? country</small><br>
            <small>??? countryGroupFlag</small><br>
            <small>P 302</small><br>
            <small>O 146</small><br>
            <small>PO 423</small><br><br>
            <small>BY 414</small><br>
            <small>GB 446</small><br>
            <small>DE 415</small><br>
            <small>GE 414</small><br>
            <small>RU 448</small><br>
            <small>SU 448</small><br>
            <small>UA 423</small><br>
            <small>US 253</small><br>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ mix('/js/backend.datatable.js') }}"></script>
    <script>
        $(function () {
            $('#tecdoc-manufacturers-table').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 25,
                ajax: {
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    url: '{{ route('backend.ajax.manufacturers.get') }}',
                    type: 'post'
                },
                columns: [
                    {data: 'id', name: 'td_manufacturers.id'},
                    {data: 'slug', name: 'td_manufacturers.slug'},
                    {data: 'manuId', name: 'td_manufacturers.manuId'},
                    {data: 'manuName', name: 'td_manufacturers.manuName'},
                    {data: 'linkingTargetTypes', name: 'td_manufacturers.linkingTargetTypes'},
                    {data: 'favorFlag', name: 'td_manufacturers.favorFlag'},
                    {data: 'isPopular', name: 'td_manufacturers.isPopular'},
                    {data: 'isVisible', name: 'td_manufacturers.isVisible'}
                ],
                order: [[0, "asc"]],
                searchDelay: 500
            });
        });
    </script>
@endsection
