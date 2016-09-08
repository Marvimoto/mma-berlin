<?php
use Illuminate\Support\Facades\Input;
echo view('admin/head'); ?>
<div class="col-md-3"></div>
<div class="col-md-6">
    {{ Form::open(array('url' => 'admin/kurse')) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Kurs erstellen', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}
</div>
<div class="col-md-3"></div>
<?php echo view('admin/foot'); ?>
