@include('admin/head')
<table class="table table-hover">
    <thead>
    <tr>
        <th>Name</th>
        <th>Gültig ab</th>
        <th>Gültig bis</th>
        <th>Status</th>
        <th>Bearbeiten</th>
        <th>Löschen</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach($versionen as $version){
    $version->valid_from = new DateTime($version->valid_from);
    $version->valid_until = new DateTime($version->valid_until);
    $today = time();

    if ($today > $version->valid_until->getTimestamp()) {
        echo('<tr style="background-color: #fd5541">');
        $status = 0;
    } else if ($today > $version->valid_from->getTimestamp()) {
        echo('<tr style="background-color: #9efb8f">');
        $status = 1;
    } else if ($today < $version->valid_until->getTimestamp()) {
        echo('<tr style="background-color: #fffb88">');
        $status = 2;
    }
    ?>
    <td>{{ $version->name }}</td>
    <td>{{ $version->valid_from->format("d.m.Y") }}</td>
    <td>{{ $version->valid_until->format("d.m.Y") }}</td>
    <td><?php switch ($status) {
            case 0:
                echo "Abgelaufen";
                break;
            case 1:
                echo "Aktiv";
                break;
            case 2:
                echo "Wartet";
                break;
        }
        ?>
    </td>
    <td>
        <a class="btn btn-small btn-info btn-xs" href="{{ URL::to('admin/stundenplaene/' . $version->id . '/edit') }}">Bearbeiten</a>
    </td>
    <td>
        {{ Form::open(array('url' => 'admin/stundenplaene/' . $version->id)) }}
        {{ Form::hidden('_method', 'DELETE') }}
        {{ Form::submit('Löschen', array('class' => 'btn btn-danger btn-xs')) }}
        {{ Form::close() }}
    </td>
    </tr>
    <?php
    }

    ?>
    </tbody>
</table>
<col-md-2></col-md-2>
<col-md-8>
    <a class="btn btn-small btn-primary" href="{{ URL::to('admin/stundenplaene/create') }}">Version hinzufügen</a>
</col-md-8>
<col-md-2></col-md-2>

@include('admin/foot')