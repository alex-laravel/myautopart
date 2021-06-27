@extends('backend.layout.main')

@section('styles')
    <link href="{{ mix('/css/backend.datatable.css') }}" rel="stylesheet">
@endsection

@section('title', trans('labels.backend.languages.management'))

@section('header')
    <h1>
        <i class="fas fa-globe-americas"></i>
        {{ trans('labels.backend.languages.management') }}
    </h1>
@endsection

@section('content')
    <div class="card card-accent-info mt-3">
        <div class="card-header">
            <h4>{{ trans('labels.backend.languages.list') }}</h4>
        </div>

        <div class="card-body">
            <table id="tecdoc-languages-table" class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>languageCode</th>
                    <th>languageName</th>
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
            $('#tecdoc-languages-table').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 25,
                ajax: {
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    url: '{{ route('backend.ajax.languages.get') }}',
                    type: 'post'
                },
                columns: [
                    {data: 'id', name: 'td_languages.id'},
                    {data: 'languageCode', name: 'td_languages.languageCode'},
                    {data: 'languageName', name: 'td_languages.languageName'}
                ],
                order: [[0, "asc"]],
                searchDelay: 500
            });
        });
    </script>
@endsection
