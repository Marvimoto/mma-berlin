<?php echo view('admin/head'); ?>
{{--{{ HTML::ul($errors->all()) }}--}}
<div class="col-md-3"></div>
<div class="col-md-6">
    {{ Form::model($kurs, array('route' => array('admin.kurse.update', $kurs->id), 'method' => 'PUT')) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Speichern', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}
</div>
<div class="col-md-3"></div>
<?php echo view('admin/foot'); ?>
