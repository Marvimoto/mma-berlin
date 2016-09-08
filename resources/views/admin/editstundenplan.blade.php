<?php
echo view('admin/head');?>
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
        {{ Form::model($version, array('route' => array('admin.stundenplaene.update', $version->id), 'method' => 'PUT')) }}
        <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', null, array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('valid_from', 'Gültig ab') }}
            {{ Form::text('valid_from', null, array('id' => 'datepicker1', 'class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('valid_until', 'Gültig bis') }}
            {{ Form::text('valid_until', null, array('id' => 'datepicker2', 'class' => 'form-control')) }}
        </div>

        {{ Form::submit('Version erstellen', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}
    </div>
    <div class="col-md-3"></div>
</div>
<div class="row">
    <div class="col-md-12">

        <table style="width: 100%" class="table table-bordered">
            <thead>
            <th>Montag</th>
            <th>Dienstag</th>
            <th>Mittwoch</th>
            <th>Donnerstag</th>
            <th>Freitag</th>
            <th>Samstag</th>
            <th>Sonntag</th>
            </thead>
            <tbody>
            <tr style="vertical-align: top">

                <?php
                $day = 0;
                foreach($stundenplan as $item){
                if ($item->tag_id > $day) {
                    if ($day != 0) {
                        echo("</div></td>");
                    }
                    $day++;
                    echo("<td><div class='grid'>");
                }
                $string = str_replace(' ', '', $item->kurs->name);
                $string = preg_replace('/[^a-z0-9 ]/i', '', $string);
                $string = strtolower($string);
                $item->begins_at = date('H:i', strtotime($item->begins_at));
                $item->ends_at = date('H:i', strtotime($item->ends_at));
                echo("<div class='grid-item " . $string . "'><div class='uhrzeit' style='font-size: 0.75em'>" . $item->begins_at . " - " . $item->ends_at . "</div><h4 class='kursname'>" . $item->kurs->name . "</h4><div style='font-size: 0.75em'>" . $item->trainer->name . "</div><div style='font-size: 0.75em'>" . $item->alter . "</div>");
                ?>
                {{ Form::open(array('url' => 'admin/modul/' . $item->id)) }}
                {{ Form::hidden('_method', 'DELETE') }}
                {{ Form::submit('Löschen', array('class' => 'btn btn-danger btn-xs')) }}
                {{ Form::close() }}
                <?php
                echo("</div>");
                }
                ?>

            </tr>
            <tr>
                <td>
                    <button class="btn btn-small" style="display:block; margin-left: auto; margin-right: auto;"
                            data-toggle="modal" data-target="#modal" data-tag=1>Hinzufügen
                    </button>
                </td>
                <td>
                    <button class="btn btn-small" style="display:block; margin-left: auto; margin-right: auto;"
                            data-toggle="modal" data-target="#modal" data-tag=2>Hinzufügen
                    </button>
                </td>
                <td>
                    <button class="btn btn-small" style="display:block; margin-left: auto; margin-right: auto;"
                            data-toggle="modal" data-target="#modal" data-tag=3>Hinzufügen
                    </button>
                </td>
                <td>
                    <button class="btn btn-small" style="display:block; margin-left: auto; margin-right: auto;"
                            data-toggle="modal" data-target="#modal" data-tag=4>Hinzufügen
                    </button>
                </td>
                <td>
                    <button class="btn btn-small" style="display:block; margin-left: auto; margin-right: auto;"
                            data-toggle="modal" data-target="#modal" data-tag=5>Hinzufügen
                    </button>
                </td>
                <td>
                    <button class="btn btn-small" style="display:block; margin-left: auto; margin-right: auto;"
                            data-toggle="modal" data-target="#modal" data-tag=6>Hinzufügen
                    </button>
                </td>
                <td>
                    <button class="btn btn-small" style="display:block; margin-left: auto; margin-right: auto;"
                            data-toggle="modal" data-target="#modal" data-tag=7>Hinzufügen
                    </button>
                </td>


            </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="button-group sort-by-button-group">
    <button class="button is-checked" data-sort-value="original-order">original order</button>
    <button class="button" data-sort-value="kursname">name</button>
    <button class="button" data-sort-value="uhrzeit">uhrzeit</button>
    <button class="button" data-sort-value="random">random</button>
    <button class="button" data-sort-value="weight">weight</button>
    <button class="button" data-sort-value="category">category</button>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Modal title</h3>
            </div>
            <div class="modal-body">
                {{ Form::open(array('url' => 'admin/modul')) }}
                {{ Form::hidden('stundenplan_id', $version->id) }}

                <div class="form-group">
                    {{ Form::label('tag', 'Tag') }}
                    {{ Form::hidden('tag_id', 'test', array('id' => 'tag_id')) }}
                    {{ Form::label('tag_name', "Nix", array('id' => 'tag_name')) }}
                </div>
                <div class="form-group">

                    <?php
                    $kursearray = array();
                    foreach ($kurse as $kurs) {
                        $kursearray[$kurs->id] = $kurs->name;
                    }?>
                    {{ Form::label('kurs', 'Kurs') }}
                    {{ Form::select('kurs_id', $kursearray, null, array('class' => 'form-control')) }}
                </div>
                <div class="form-group">

                    <?php
                    $trainerarray = array();
                    foreach ($trainer as $coach) {
                        $trainerarray[$coach->id] = $coach->name;
                    }?>
                    {{ Form::label('trainer', 'Trainer') }}
                    {{ Form::select('trainer_id', $trainerarray, null, array('class' => 'form-control')) }}
                </div>
                <div class="form-group">

                    <?php
                    $raumarray = array();
                    foreach ($raeume as $raum) {
                        $raumarray[$raum->id] = $raum->name;
                    }?>
                    {{ Form::label('raum', 'Raum') }}
                    {{ Form::select('raum_id', $raumarray, null, array('class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('alter_label', 'Alter') }}
                    {{ Form::select('alter', array('ab 14' => 'ab 14', 'ab 20' => 'ab 20', '10-13' => '10-13'), null, array('class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('begin', 'Beginnt um') }}
                    {{ Form::text('begins_at', '', array('id' => 'timepicker1')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('begin', 'Endet um') }}
                    {{ Form::text('ends_at', '', array('id' => 'timepicker2')) }}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
                {{ Form::submit('Hinzufügen', array('class' => 'btn btn-primary')) }}

                {{ Form::close() }}
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php echo view('admin/foot'); ?>

<style>
    th {
        margin-left: auto;
        margin-right: auto;
    }

    .grid {
        background-color: #FFFFFF;
    }

    .grid-item {
        background-color: #3bcaff;
        font-size: 16px;
        width: 100%;
        font-family: "Helvetica Neue";
        margin-bottom: 5px;
        margin-top: 5px;
        margin-left: auto;
        margin-right: auto;
        padding-top: 10px;
        padding-bottom: 10px;
        padding-left: 10px;
        padding-right: 10px;
        border: 10px;
        border-color: #000000;
    }

    label {
        display: block;
    }

    h4 {
        color: #464646;
    }

    .ktbbasics {
        background-color: #ffff00;
    }

    .ktbpratzesandsacksparring {
        background-color: #ffff00;
    }
    .kickthaiboxen {
        background-color: #ffff00;
    }

    .freiestraining {
        background-color: #b7b7b7;
    }

    .mma {
        background-color: #ff6111;
    }

    .mmabasics {
        background-color: #ff6111;
    }

    .grappling {
        background-color: #ff9e0e;
    }


</style>
<script>
    $(function () {
        $('.grid').isotope({
            itemSelector: '.grid-item',
            layoutMode: 'vertical',
            getSortData: {
                kursname: '.kursname',
                uhrzeit: '.uhrzeit'
            },
            sortBy: 'uhrzeit'

        });
        $('.grid').isotope({sortBy: 'uhrzeit'});
    });
    $('.sort-by-button-group').on('click', 'button', function () {
        var sortValue = $(this).attr('data-sort-value');
        $('.grid').isotope({sortBy: sortValue});
    });

    $("#datepicker1").datepicker({
        dateFormat: 'dd.mm.yy'
    });
    $("#datepicker2").datepicker({
        dateFormat: 'dd.mm.yy'
    });
    $('#timepicker1').timepicki({
        show_meridian: false,
        min_hour_value: 7,
        max_hour_value: 22,
        step_size_minutes: 5,
        overflow_minutes: false,
        increase_direction: 'up',
        disable_keyboard_mobile: false,
        start_time: ["10", "00"]
    });


    $('#timepicker2').timepicki({
        show_meridian: false,
        min_hour_value: 7,
        max_hour_value: 22,
        step_size_minutes: 5,
        overflow_minutes: false,
        increase_direction: 'up',
        disable_keyboard_mobile: false,
        start_time: ["10", "00"]
    });



    $("#datepicker2").change(function () {
        var validfrom = $("#datepicker1").val();
        var validuntil = $("#datepicker2").val();
        if (validfrom > validuntil) {
            alert("Ungültig!");
            $("#datepicker2").val("");
        }
    });
    $("#timepicker1").change(function() {
        var time = $('#timepicker1').val();
        time = time.split(":");
        console.log(time[0]);
        $('#timepicker2').timepicki({
            start_time: [time[0], time[1]]
        });
    });
        $('#modal').on('show.bs.modal', function (e) {

            var tag_id = e.relatedTarget.dataset.tag;
            $('#tag_id').attr('value', tag_id);
            var tagname;
            switch (tag_id) {
                case '1':
                    tagname = 'Montag';
                    break;
                case '2':
                    tagname = 'Dienstag';
                    break;
                case '3':
                    tagname = 'Mittwoch';
                    break;
                case '4':
                    tagname = 'Donnerstag';
                    break;
                case '5':
                    tagname = 'Freitag';
                    break;
                case '6':
                    tagname = 'Samstag';
                    break;
                case '7':
                    tagname = 'Sonntag';
                    break;
            }
            console.log(tagname);
            $('#tag_name').html(tagname);
        });
</script>