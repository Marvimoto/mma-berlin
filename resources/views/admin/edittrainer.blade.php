<?php echo view('admin/head'); ?>
<div class="col-md-3"></div>
<div class="col-md-6">
{{ Form::model($trainer, array('route' => array('admin.trainer.update', $trainer->id), 'files' => true, 'method' => 'PUT')) }}

<div class="form-group">
    {{ Form::label('name', 'Name') }}
    {{ Form::text('name', null, array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('teaches', 'Unterrichtet') }}
    {{ Form::text('teaches', null, array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('career', 'Laufbahn') }}
    {{ Form::text('career', null, array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('job', 'Beruf') }}
    {{ Form::text('job', null, array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('trainer_since', 'Trainer seit') }}
    {{ Form::text('trainer_since', null, array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('languages', 'Sprachen') }}
    {{ Form::text('languages', null, array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('fav_technique', 'Lieblingstechnik') }}
    {{ Form::text('fav_technique', null, array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('misc', 'Sonstiges') }}
    {{ Form::text('misc', null, array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('links', 'Links') }}
    {{ Form::text('links', null, array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('photo', 'Foto') }}
    {{ Form::file('photo', array('class' => 'form-control')) }}
    <img src="{{ asset('images') . "/" . $trainer->photo }}" style="height: 140px; width: 140px"
         class="img-circle img-responsive">
</div>

{{ Form::submit('Speichern', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}
</div>
<div class="col-md-3"></div>
<?php echo view('admin/foot'); ?>
