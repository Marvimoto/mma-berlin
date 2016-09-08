<?php echo view('admin/head'); ?>
<table class="table table-hover">
    <thead>
    <tr>
        <th>Name</th>
        <th>Bearbeiten</th>
        <th>Löschen</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach($kurse as $kurs){
    ?>
    <tr>
        <td><?php echo $kurs->name; ?></td>
        <td>
            <a class="btn btn-small btn-info btn-xs" href="{{ URL::to('admin/kurse/' . $kurs->id . '/edit') }}">Bearbeiten</a>
        </td>
        <td>
            {{ Form::open(array('url' => 'admin/kurse/' . $kurs->id)) }}
            {{ Form::hidden('_method', 'DELETE') }}
            {{ Form::submit('Löschen', array('class' => 'btn btn-danger btn-xs')) }}
            {{ Form::close() }}
        </td>
    </tr>
    <?php
    }

    ?>
    </tbody>
</table>
<col-md-2></col-md-2>
<col-md-8>
    <a class="btn btn-small btn-primary" href="{{ URL::to('admin/kurse/create') }}">Kurs hinzufügen</a>
</col-md-8>
<col-md-2></col-md-2>

<?php echo view('admin/foot'); ?>