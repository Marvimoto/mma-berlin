<?php
use Illuminate\Support\Facades\Input;
echo view('admin/head'); ?>
<div class="col-md-3"></div>
<div class="col-md-6">
    {{ Form::model($gym, array('route' => array('admin.gyms.update', $gym->id), 'method' => 'PUT')) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('ort', 'Ort') }}<br>
        {{ Form::text('ort', null, array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Änderungen bestätigen', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}
</div>
<div class="col-md-3"></div>

<?php echo view('admin/foot'); ?>