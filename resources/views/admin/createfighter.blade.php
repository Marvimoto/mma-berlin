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

    {{ Form::open(array('url' => 'admin/fighters', 'files' => true)) }}
    <div class="form-group">
        {{ Form::label('vorname', 'Vorname') }}
        {{ Form::text('vorname', null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('gym', 'Gym') }}<br>
        {{ Form::select('gym', $gyms, null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('photo', 'Foto') }}
        {{ Form::file('photo', array('class' => 'form-control')) }}
    </div>
    {{ Form::submit('Kämpfer erstellen', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}
</div>
<div class="col-md-3"></div>

<?php echo view('admin/foot'); ?>