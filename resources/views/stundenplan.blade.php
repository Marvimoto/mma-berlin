<?php echo view('head'); ?>
<div class="row">
    <button class="btn btn-link" id="filterButton" type="button" data-toggle="collapse" data-target="#collapseFilter"
            aria-expanded="false" aria-controls="collapseFilter" style="font-size: 1.25em">
        <span class="glyphicon glyphicon-chevron-down"></span> Filter
    </button>
    <div class="col-md-12 collapse" id="collapseFilter">
        <div class="col-md-3">
            <h4>Kurse anzeigen:</h4>
            <div class="checkbox" id="radiokurse">
                <?php foreach($kurse as $kurs){
                $string = str_replace(' ', '', $kurs->name);
                $string = preg_replace('/[^a-z0-9 ]/i', '', $string);
                $string = strtolower($string);
                ?>

                <label>
                    <input class="kurse" type="checkbox" value="{{ $string }}" checked>
                    {{ $kurs->name }}
                </label>
                <?php } ?>
            </div>
            <button class="btn btn-sm btn-primary" id="allekurse">Alle</button>
            <button class="btn btn-sm btn-primary" id="keinekurse">Keine</button>
        </div>
    </div>
</div>
<div class="row" style="margin-top: 10px">
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
                    foreach ($stundenplan as $item) {
                        if ($item->tag_id > $day) {
                            if ($day != 0) {
                                echo("</div></td>");
                            }
                            $day++;
                            echo("<td style='width:14.3%'><div class='grid'>");
                        }
                        $string = str_replace(' ', '', $item->kurs->name);
                        $string = preg_replace('/[^a-z0-9 ]/i', '', $string);
                        $string = strtolower($string);
                        $item->begins_at = date('H:i', strtotime($item->begins_at));
                        $item->ends_at = date('H:i', strtotime($item->ends_at));
                        echo("<div data-kurzname = '" . $string . "' class='grid-item " . $string . "'><h4 class='kursname'>" . $item->kurs->name . "</h4><div style='font-size: 0.75em'>" . $item->trainer->name . "</div><div class='uhrzeit' style='font-size: 0.75em'>" . $item->begins_at . " - " . $item->ends_at . "</div><div style='font-size: 0.75em'>" . $item->alter . "</div>");
                        ?>

                <?php
                        echo("</div>");
                    }
                    ?>

                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php echo view('foot'); ?>
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
    @media (max-width: 768px){
        .grid-item {
            min-width: 290px;
        }
        td {
            min-width: 310px;;
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
            $("input.kurse:checkbox").each(function () {
                $(this).prop('checked', true);
            })
            sortByArray();
        });
        $('#keinekurse').click(function () {
            $("input.kurse:checkbox").each(function () {
                $(this).prop('checked', false);
            })
            sortByArray();
        });

        $('.kurse').change(function () {
            sortByArray();
        });
    });

    function sortByArray() {
        var checkedarray = [];
        $("input.kurse:checkbox").each(function () {
            if ($(this).prop('checked') == true) {
                checkedarray.push($(this).val());
            }
        });
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
