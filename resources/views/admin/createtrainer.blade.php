<?php
use Illuminate\Support\Facades\Input;
echo view('admin/head'); ?>
<div class="col-md-3"></div>
<div class="col-md-6">
    {{ Form::open(array('url' => 'admin/trainer', 'files' => true)) }}

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
    </div>

    {{ Form::submit('Trainer erstellen', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}
</div>
<div class="col-md-3"></div>
<?php echo view('admin/foot'); ?>
