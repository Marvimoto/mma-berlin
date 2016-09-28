<?php
use Illuminate\Support\Facades\Input;

?>
@include('admin.head')
<div class="col-md-3"></div>
<div class="col-md-6">
    {{ Form::model($fighter, array('route' => array('admin.fighters.update', $fighter->id), 'method' => 'PUT', 'files' => true)) }}

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
        {{ Form::select('gym', $gyms, $fighter->gym_id, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('photo', 'Foto') }}
        <div class="row">
        <div class="col-md-4">
            @if ($fighter->photo != "")
                <img src="{{ asset('images/fighters') . "/" . $fighter->photo }}" style="height: 140px; width: 140px"
                     class="img-responsive form-control">
            @else
                <img src="{{ asset('images/user.png') }}" class="img-responsive form-control" style="max-width: 100%; height: auto">
            @endif
        </div>
        <div class="col-md-8">
            {{ Form::file('photo', array('class' => 'form-control')) }}
        </div>
        </div>
    </div>
    {{ Form::submit('Kämpfer erstellen', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}
</div>
<div class="col-md-3"></div>

@include('admin.foot')