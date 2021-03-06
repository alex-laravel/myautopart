@extends('backend.layout.main')

@section('styles')
    <link href="{{ mix('/css/backend.datatable.css') }}" rel="stylesheet">
@endsection

@section('title', trans('labels.backend.direct-article-details.management'))

@section('header')
    <h1>
        <i class="fas fa-tools"></i>
        {{ trans('labels.backend.direct-article-details.management') }}
    </h1>
@endsection

@section('content')


        <div class="card card-accent-success mt-3">
            <div class="card-header">
                <h4 class="d-inline-block">{{ trans('labels.general.synchronize') }}</h4>

                <div class="float-right">
                    <form class="form-horizontal" action="{{ route('backend.direct-article-details.sync-assets') }}" method="post">
                        @csrf
                        <button class="btn btn-block btn-info" type="submit">{{ trans('buttons.general.synchronize-assets') }}</button>
                    </form>
                </div>

                <div class="float-right mr-2">
                    <form class="form-horizontal" action="{{ route('backend.direct-article-details.sync') }}" method="post">
                        @csrf
                        <button class="btn btn-block btn-primary" type="submit">{{ trans('buttons.general.synchronize') }}</button>
                    </form>
                </div>
            </div>

            <div class="card-body">
            </div>
        </div>

    <div class="card card-accent-info mt-3">
        <div class="card-header">
            <h4 class="d-inline-block">{{ trans('labels.backend.direct-article-details.list') }}</h4>

            <div class="float-right">
                @include('backend.tecdoc-direct-articles.partials.header-buttons')
            </div>
        </div>

        <div class="card-body">
            <table id="tecdoc-direct-article-details-table" class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>articleId</th>
                    <th>articleName</th>
{{--                    <th>designation</th>--}}
{{--                    <th>masterDesignation</th>--}}
{{--                    <th>usageDesignation</th>--}}
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
            $('#tecdoc-direct-article-details-table').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 25,
                ajax: {
                    headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                    url: '{{ route('backend.ajax.direct-article-details.get') }}',
                    type: 'post'
                },
                columns: [
                    {data: 'id', name: 'td_direct_article_details.id'},
                    {data: 'articleId', name: 'td_direct_article_details.articleId'},
                    {data: 'articleName', name: 'td_direct_article_details.articleName'},
                    // {data: 'assemblyGroup', name: 'td_direct_articles.assemblyGroup'},
                    // {data: 'designation', name: 'td_direct_articles.designation'},
                    // {data: 'masterDesignation', name: 'td_direct_articles.masterDesignation'},
                    // {data: 'usageDesignation', name: 'td_direct_articles.usageDesignation'},
                ],
                order: [[0, "asc"]],
                searchDelay: 500
            });
        });
    </script>
@endsection

