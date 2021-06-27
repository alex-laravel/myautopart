@extends('backend.layout.main')

@section('styles')
    <link href="{{ mix('/css/backend.datatable.css') }}" rel="stylesheet">
@endsection

@section('title', trans('labels.backend.models.management'))

@section('header')
    <h1>
        <i class="fas fa-car"></i>
        {{ trans('labels.backend.models.management') }}
    </h1>
@endsection

@section('content')
    <div class="card card-accent-info mt-3">
        <div class="card-header">
            <h4>{{ trans('labels.backend.models.list') }}</h4>
        </div>

        <div class="card-body">
            <table id="tecdoc-models-table" class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>manuId</th>
                    <th>modelId</th>
                    <th>modelname</th>
                    <th>yearOfConstrFrom</th>
                    <th>yearOfConstrTo</th>
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
            $('#tecdoc-models-table').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 25,
                ajax: {
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    url: '{{ route('backend.ajax.models.get') }}',
                    type: 'post'
                },
                columns: [
                    {data: 'id', name: 'td_model_series.id'},
                    {data: 'manuId', name: 'td_model_series.manuId'},
                    {data: 'modelId', name: 'td_model_series.modelId'},
                    {data: 'modelname', name: 'td_model_series.modelname'},
                    {data: 'yearOfConstrFrom', name: 'td_model_series.yearOfConstrFrom'},
                    {data: 'yearOfConstrTo', name: 'td_model_series.yearOfConstrTo'}
                ],
                order: [[0, "asc"]],
                searchDelay: 500
            });
        });
    </script>
@endsection
