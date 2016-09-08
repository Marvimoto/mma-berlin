<?php
use Illuminate\Support\Facades\Input;
echo view('admin/head'); ?>
<div class="col-md-3"></div>
<div class="col-md-6">
    {{ Form::open(array('url' => 'admin/stundenplaene')) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('valid_from', 'Gültig ab') }}<br>
        {{ Form::text('valid_from', '', array('id' => 'datepicker1')) }}
    </div>
    <div class="form-group">
        {{ Form::label('valid_until', 'Gültig bis') }}<br>
        {{ Form::text('valid_until', '', array('id' => 'datepicker2')) }}
    </div>

    {{ Form::submit('Version erstellen', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}
</div>
<div class="col-md-3"></div>

<?php echo view('admin/foot'); ?>
<script>
    $(function () {
        $("#datepicker1").datepicker();
        $("#datepicker2").datepicker();
    });
    $(function () {
        $("#datepicker1").datepicker("option", "dateFormat", 'dd.mm.yy');
        $("#datepicker2").datepicker("option", "dateFormat", 'dd.mm.yy');
    });
    $("#datepicker2").change(function () {
        var validfrom = $("#datepicker1").val();
        var validuntil = $("#datepicker2").val();
        if (validfrom > validuntil) {
            alert("Ungültig!");
            $("#datepicker2").val("");
        }
    });
</script>