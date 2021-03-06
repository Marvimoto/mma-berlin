@include('admin.head')
<table class="table table-hover">
    <thead>
    <tr>
        <th>Name</th>
        <th>Ort</th>
        <th>Bearbeiten</th>
        <th>Löschen</th>
    </tr>
    </thead>
    <tbody>
    @foreach($gyms as $gym)
        <tr>
            <td>{{ $gym->name }}</td>
            <td>{{ $gym->ort }}</td>
            <td>
                <a class="btn btn-small btn-info btn-xs" href="{{ URL::to('admin/gyms/' . $gym->id . '/edit') }}">Bearbeiten</a>
            </td>
            <td>
                {{ Form::open(array('url' => 'admin/gyms/' . $gym->id)) }}
                {{ Form::hidden('_method', 'DELETE') }}
                {{ Form::submit('Löschen', array('class' => 'btn btn-danger btn-xs')) }}
                {{ Form::close() }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<col-md-2></col-md-2>
<col-md-8>
    <a class="btn btn-small btn-primary" href="{{ URL::to('admin/gyms/create') }}">Gym hinzufügen</a>
</col-md-8>
<col-md-2></col-md-2>

@include('admin.foot')