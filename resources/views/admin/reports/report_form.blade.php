{{Form::open(['url'=>route('reports.generate_report', ['action'=>$action]), 'method'=>'get'])}}
<div class="box box-success">
    <div class="box-body">
        @yield('additional_inputs')
        <div class="row">
            <div class="col-md-4">
                <input type="date" class="form-control" name="date_from"
                       value="{{ old('date_from',\Carbon\Carbon::now()->startOfMonth()->format('Y-m-d')) }}">
            </div>
            <div class="col-md-4">
                <input type="date" class="form-control" name="date_to"
                       value="{{ old('date_to',\Carbon\Carbon::now()->format('Y-m-d')) }}">
            </div>
            <div class="col-md-4">

                {{Form::submit('Generate report', [
                    'class'=>'btn btn-default',
                    'name'=>'download'
                ])}}
            </div>
        </div>
    </div>

</div>
<!--/.box -->
{{Form::close()}}
