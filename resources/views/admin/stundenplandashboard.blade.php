<?php echo view('admin/head'); ?>
<div class="row">
<div class="col-md-1"></div>
    <div class="col-md-5">
    <h2>Hallo {{$user->name}}</h2>
    </div>
</div>
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-5">
        <div class="well">
            <p>Aktueller Stundenplan ist der <a href="{{url('admin/stundenplaene/' . $version->id . '/edit')}}">{{ $version->name }}</a>.</p>
            <p>Der Stundenplan beinhaltet <span style="color: #ff6111">{{$kurscount}}</span> Module.</p>
        </div>
    </div>
    <div class="col-md-5">
        <div class="well">
            Test
        </div>
    </div>
</div>
<?php echo view('admin/foot'); ?>
