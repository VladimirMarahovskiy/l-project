
<table class="box table table-striped table-hover display responsive nowrap m-t-0 dataTable dtr-inline">
    <thead>
    <tr>
        <th style="width: 50%">Имя файла</th>
        <th style="width: 30%">Дата</th>
        <th style="width: 20%">Дейстия</th>
    </tr>
    </thead>
    <tbody>
    @forelse ($files as $file)
        <tr>
            <td>{{$file['name']}}</td>
            <td>{{ date('d.m.Y H:i:s',  $file['date']) }}</td>
            <td>
                <form action="{{ route('reports.download', ['action'=>$action,'file'=> $file['name']])}}" method="post">
                    {!! csrf_field() !!}
                    <button type="submit" class="btn btn-xs btn-default"><i class="fa fa-download"></i> Скачать</button>
                </form>
                <form action="{{ route('reports.delete', ['action'=>$action,'file'=> $file['name']])}}" method="post">
                    {!! csrf_field() !!}
                    <button type="submit" data-file="{{$file['name']}}"  class="btn btn-xs btn-default delete-file"><i class="fa fa-trash"></i> Удалить</button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="3" class="text-center text-bold">No reports</td>
        </tr>
    @endforelse
    </tbody>
</table>

