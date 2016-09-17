@include('head')
<div class="row">
    @if (isset($stundenplan))
        <button class="btn btn-link" id="filterButton" type="button" data-toggle="collapse"
                data-target="#collapseFilter"
                aria-expanded="false" aria-controls="collapseFilter" style="font-size: 1.25em">
            <span class="glyphicon glyphicon-chevron-down"></span> Filter
        </button>
        <div class="col-md-12 collapse" id="collapseFilter">
            <div class="col-md-3 clearfix">
                <h4>Kurse anzeigen:</h4>
                @foreach($kurse as $kurs)
                    <?php
                    $string = str_replace(' ', '', $kurs->name);
                    $string = preg_replace('/[^a-z0-9 ]/i', '', $string);
                    $string = strtolower($string);
                    ?>
                    <button class="kurse btn btn-success btn-sm"
                            style="margin-top: 1px; margin-bottom: 1px; width: 100%"
                            id="{{ str_slug($kurs->name, '') }}">{{ $kurs->name }}</button>
                @endforeach
                <button class="btn btn-sm btn-primary pull-left" id="allekurse" style="width: 45%">Alle</button>
                <button class="btn btn-sm btn-primary pull-right" id="keinekurse" style="width:45%">Keine</button>
            </div>
            <div class="col-md-3">
                <h4>Nächster Stundenplan:</h4>
                @if (isset($nstundenplan))
                    <?php $url = route('stundenplan', ['id' => $nstundenplan->id]); ?>
                    <a href="{{ $url }}">{{ $nstundenplan->name}}</a><br>
                    <p>Gültig ab dem {{ date("d.m.Y", strtotime($nstundenplan->valid_from)) }}</p>
                @else
                    <p>Kein Folgestundenplan vorhanden</p>
                @endif
            </div>
        </div>
</div>
<div class="row" style="margin-top: 10px">
    @if (isset($nstundenplan))
        @if (date("Y-m-d") <= date("Y-m-d", strtotime($nstundenplan->valid_from)))
            <p style="font-size: 20px; padding-bottom: 10px; padding-top: 10px; padding-left: 10px; padding-right: 10px; border-radius: 10px"
               class="bg-warning">Ab dem {{ date("d.m.Y", strtotime($nstundenplan->valid_from)) }} beginnt der <a
                        href="{{ $url }}">{{ $nstundenplan->name}}</a></p>
        @endif
    @endif
    <div col="col-md-12">
        <div class="table-responsive">
            <table style="width: 100%" class="table table-bordered">
                <thead>
                <tr>
                    <th>Montag</th>
                    <th>Dienstag</th>
                    <th>Mittwoch</th>
                    <th>Donnerstag</th>
                    <th>Freitag</th>
                    <th>Samstag</th>
                    <th>Sonntag</th>
                </tr>
                </thead>
                <tbody>
                <tr style="vertical-align: top">
            <?php
            $day = 0;
            ?>
            @foreach ($stundenplan as $item)
                @if ($item->tag_id > $day)
                    @if ($day != 0)
        </div>
        </td>
        @endif
        <?php
        $day++
        ?>
        <td style='width:14.3%'>
            <div class='grid'>
                @endif
                <?php
                $string = str_replace(' ', '', $item->kurs->name);
                $string = preg_replace('/[^a-z0-9 ]/i', '', $string);
                $string = strtolower($string);
                $item->begins_at = date('H:i', strtotime($item->begins_at));
                $item->ends_at = date('H:i', strtotime($item->ends_at));
                ?>
                <div data-kurzname="{{ $string }}" class='grid-item {{ $string }}'><h4
                            class='kursname'>{{$item->kurs->name }}</h4>
                    <div style='font-size: 0.75em'>{{$item->trainer->name }} </div>
                    <div class='uhrzeit' style='font-size: 0.75em'>{{ $item->begins_at }} - {{ $item->ends_at }} </div>
                    <div style='font-size: 0.75em'>{{ $item->alter }} </div>


                </div>
                @endforeach
                </tr>
                </tbody>
                </table>
            </div>
    </div>
    @else
        <p style="text-align: center; font-size: 3em">Kein Stundenplan vorhanden</p>
    @endif

</div>


@include('foot')
<style>
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
        border-radius: 5px;
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

    .freiestraining {
        background-color: #b7b7b7;
    }

    .kickthaiboxen {
        background-color: #ffff00;
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

    .btn-sm {
        margin-left: 5px;
        margin-right: 5px;
    }

    h3 {
        padding-top: 0px;
        margin-top: 0px;
    }

    @media (max-width: 768px) {
        .grid-item {
            min-width: 290px;
        }

        td {
            min-width: 310px;
        }
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

//        var gridwidth = [];
//        $('.grid-item').each(function () {
//            gridwidth.push($(this).width());
//        })
//        gridwidth.sort();
//        $('.grid-item').each(function () {
//            $(this).width(gridwidth[0]);
//        })
//    })

        $('#filterButton').click(function () {
            var change = 0;
            if (change == 0) {
                $('.glyphicon-chevron-down').each(function () {
                    $(this).attr('class', 'glyphicon glyphicon-chevron-up');
                    change++;
                });
            }
            if (change == 0) {
                $('.glyphicon-chevron-up').each(function () {
                    $(this).attr('class', 'glyphicon glyphicon-chevron-down');
                    change++;
                });
            }


        });
        $('#allekurse').click(function () {
            $(".kurse").each(function () {
                $(this).addClass('btn-success');
                $(this).removeClass('btn-danger');
            });
            sortByArray();
        });
        $('#keinekurse').click(function () {
            $(".kurse").each(function () {
                $(this).removeClass('btn-success');
                $(this).addClass('btn-danger');
            });
            sortByArray();
        });

        $('.kurse').click(function () {
            if ($(this).hasClass('btn-success')) {
                $(this).removeClass('btn-success');
                $(this).addClass('btn-danger');
            }
            else {
                $(this).addClass('btn-success');
                $(this).removeClass('btn-danger');
            }
            sortByArray();
        });
    });

    function sortByArray() {
        var checkedarray = [];
        $(".kurse").each(function () {
            console.log($(this));
            if ($(this).hasClass('btn-success') == true) {
                checkedarray.push($(this).attr('id'));
            }
        });
        console.log(checkedarray);
        $('.grid').isotope({
            filter: function () {
                var kurzname = $(this).attr('data-kurzname');
                if (jQuery.inArray(kurzname, checkedarray) != -1) {
                    return true;
                } else {
                    return false;
                }
            }
        });
    }


</script>
