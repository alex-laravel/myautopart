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
            <h4>{{ trans('labels.backend.manufacturers.list') }}</h4>
        </div>

        <div class="card-body">
            <table id="tecdoc-manufacturers-table" class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>manuId</th>
                    <th>manuName</th>
                    <th>slug</th>
                    <th>isVisible</th>
                    <th>manuName</th>
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
                    {data: 'manuId', name: 'td_manufacturers.manuId'},
                    {data: 'manuName', name: 'td_manufacturers.manuName'},
                    {data: 'slug', name: 'td_manufacturers.slug'},
                    {data: 'isVisible', name: 'td_manufacturers.isVisible'},
                    {data: 'isPopular', name: 'td_manufacturers.isPopular'}
                ],
                order: [[0, "asc"]],
                searchDelay: 500
            });
        });
    </script>
@endsection
