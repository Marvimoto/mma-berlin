@include('head')

<div class="row">
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
        <?php
        $years = [];
        for ($i = 2012; $i >= 1940; $i--) {
            array_push($years, $i);
        };
        $months = [];
        $monthnames = ['Januar', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'];
        for ($i = 1; $i <= 12; $i++) {
            $months[$i] = $monthnames[$i - 1];
        };
        $days = [];
        for ($i = 1; $i <= 31; $i++) {
            array_push($days, $i);
        };
        ?>

        {{ Form::open(array('url' => 'probetraining')) }}
        <div class="form-group">
            {{ Form::label('vorname', 'Vorname') }}
            {{ Form::text('vorname', null, array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('name', 'Name') }}
            {{ Form::text('name', null, array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('telefon', 'Telefon') }}
            {{ Form::text('telefon', null, array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('text', 'Zusätzliche Informationen (optional)') }}
            {{ Form::textarea('text', null, array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('geburtsdatum', 'Geburtsdatum') }}<br>
            {{ Form::select('tag', $days, null, array('class' => 'form-control', 'style' => 'width: 32%; display: inline')) }}
            {{ Form::select('monat', $months, null, array('class' => 'form-control', 'style' => 'width: 33%; display: inline')) }}
            {{ Form::select('jahr', $years, null, array('class' => 'form-control', 'style' => 'width: 33%; display: inline')) }}
        </div>
        <div class="form-group">
            {{ Form::label('kurs', 'Kurs') }}
            {{ Form::text('kurs', null, array('class' => 'form-control')) }}
        </div>
            @if (isset($stundenplan))
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


        {{ Form::submit('Absenden', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}
    </div>
    <div class="col-md-3"></div>
</div>
@include('foot')