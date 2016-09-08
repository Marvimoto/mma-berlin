<?php
use Illuminate\Support\Facades\Input;
echo view('admin/head'); ?>
<div class="col-md-3"></div>
<div class="col-md-6">
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if ($gym->sure == 1)
        <div class="alert alert-danger">
            <ul>
                Es gibt bereits ein Gym mit dem Namen <strong>{{ $gym->name }}</strong>. Sind Sie sicher, dass Sie das
                Gym nicht
                doppelt erstellen?
            </ul>
        </div>
    @endif

    {{ Form::model($gym, array('route' => array('admin.gyms.store', $gym->id), 'method' => 'POST')) }}
    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('ort', 'Ort') }}<br>
        {{ Form::text('ort', null, array('class' => 'form-control')) }}
    </div>
    @if ($gym->sure == 1)
        {{ Form::hidden('sure', '1') }}
    @else
        {{Form::hidden('sure', '0')}}
    @endif
    {{ Form::submit('Gym erstellen', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}
</div>
<div class="col-md-3"></div>

<?php echo view('admin/foot'); ?>