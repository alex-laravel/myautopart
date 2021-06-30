@extends('backend.layout.main')

@section('styles')
    <link href="{{ mix('/css/backend.datatable.css') }}" rel="stylesheet">
@endsection

@section('title', trans('labels.backend.short-cuts.management'))

@section('header')
    <h1>
        <i class="fab fa-buromobelexperte"></i>
        {{ trans('labels.backend.short-cuts.management') }}
    </h1>
@endsection

@section('content')
    <div class="card card-accent-info mt-3">
        <div class="card-header">
            <h4 class="d-inline">{{ trans('labels.backend.short-cuts.list') }}</h4>

            <div class="float-right">
                @include('backend.tecdoc-short-cuts.partials.header-buttons')
            </div>
        </div>

        <div class="card-body">
            <table id="tecdoc-short-cuts-table" class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>shortCutId</th>
                    <th>shortCutName</th>
                </tr>
                </thead>
            </table>

            <strong class="d-block">NOTES:</strong>
            <small>P - 17</small><br>
            <small>O - 16</small><br>
            <small>L - 17</small><br>
            <small>A - 17</small><br>
            <small>M - 17</small><br>
            <small>K - 16</small><br>
            <small>U - 6</small><br>

        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ mix('/js/backend.datatable.js') }}"></script>
    <script>
        $(function () {
            $('#tecdoc-short-cuts-table').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 25,
                ajax: {
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    url: '{{ route('backend.ajax.short-cuts.get') }}',
                    type: 'post'
                },
                columns: [
                    {data: 'id', name: 'td_short_cuts.id'},
                    {data: 'shortCutId', name: 'td_short_cuts.shortCutId'},
                    {data: 'shortCutName', name: 'td_short_cuts.shortCutName'}
                ],
                order: [[0, 'asc']],
                searchDelay: 500
            });
        });
    </script>
@endsection
