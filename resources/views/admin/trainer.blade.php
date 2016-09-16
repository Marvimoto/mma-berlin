@include('admin/head')
<style>
    td {
        vertical-align: center;
    }
</style>
<table class="table table-hover">
    <thead>
    <tr>
        <th style="width: 60px"></th>
        <th>Name</th>
        <th>Bearbeiten</th>
        <th>Löschen</th>
    </tr>
    </thead>
    <tbody>
    @foreach($trainers as $trainer)
    <tr>
        <td id="phototd" style="width: 80px"><img src="{{ asset('images') . '/' . $trainer->photo }}" class="img-circle img-responsive" style="height: 60px;"></td>
        <td> {{ $trainer->name }}</td>
        <td>
            <a class="btn btn-small btn-info btn-xs" href="{{ URL::to('admin/trainer/' . $trainer->id . '/edit') }}">Bearbeiten</a>
        </td>
        <td>
            {{ Form::open(array('url' => 'admin/trainer/' . $trainer->id)) }}
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
    <a class="btn btn-small btn-primary" href="{{ URL::to('admin/trainer/create') }}">Trainer hinzufügen</a>
</col-md-8>
<col-md-2></col-md-2>

<script>
    $(function(){
        $('.img-circle').mouseenter(function(){
            $('.img-circle').css('cursor', '-webkit-zoom-in');
        });
        $('.img-circle').click(function () {
            if ($(this).css('height') == "60px"){
                $('#phototd').css('width', '210px');
                $(this).css('height', '200px');
                $(this).css('cursor', '-webkit-zoom-out');
            }
            else {
                $('#phototd').css('width', '80px');
                $(this).css('height', '60px');
                $(this).css('cursor', '-webkit-zoom-in');
            }
        });
    });
</script>

@include('admin/foot')