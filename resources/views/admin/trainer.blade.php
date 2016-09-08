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
    foreach($trainers as $trainer){
    ?>
    <tr>
        <td><?php echo $trainer->name; ?></td>
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
    <?php
    }

    ?>
    </tbody>
</table>
<col-md-2></col-md-2>
<col-md-8>
    <a class="btn btn-small btn-primary" href="{{ URL::to('admin/trainer/create') }}">Trainer hinzufügen</a>
</col-md-8>
<col-md-2></col-md-2>

<?php echo view('admin/foot'); ?>