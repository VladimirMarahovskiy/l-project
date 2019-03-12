@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            Reports
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
            <li>{{ trans('crud.reports') }}</li>
            @if( empty($reportData))
                <li class="active">{{ $title }}</li>
            @else
                <li>
                    <a href="{{route('reports.generate_report', ['action'=>$action])}}">{{ $title }}</a>
                </li>
                <li class="active">просмотр отчета</li>
            @endif
        </ol>
    </section>
@endsection
@section('content')
    <div class="row">
        @if( empty($reportData))
            <div class="col-xs-12 col-sm-12">
                 @include('admin.reports.report_form')
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                @include('admin.reports.file_table')
            </div>
        @endif
    </div>
@endsection

@section('after_scripts')
    <script>
        $('button.delete-file').on('click', function (event) {
            var file = $(this).data('file'),
                question = confirm('Вы точно хотите удалить этот файл: ' + file);
            if(!question) {
                event.preventDefault();
            }
        });
    </script>
@endsection
