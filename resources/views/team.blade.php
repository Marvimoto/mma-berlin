<?php echo view('head'); ?>
<?php foreach($trainers as $trainer){ ?>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="well">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-9">
                    <h3>{{ $trainer->name }}</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 col-sm-2 trainer-photo">
                    @if ($trainer->photo != "")
                        <img src="{{ asset('images') . "/" . $trainer->photo }}" class="img-circle" style="max-width: 100%; height: auto">
                    @else
                        <img src="{{ asset('images/user.png') }}" class="img-circle" style="max-width: 100%; height: auto">
                    @endif
                </div>

                <div class="col-md-9 col-sm-10">
                    <div class="row">
                        <div class="col-md-3">
                            <b>Unterrichtet:</b>
                        </div>
                        <div class="col-md-9">
                            {{ $trainer->teaches }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <b>Laufbahn:</b>
                        </div>
                        <div class="col-md-9">
                            {{ $trainer->career }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <b>Trainer seit:</b>
                        </div>
                        <div class="col-md-9">
                            {{ $trainer->trainer_since }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <b>Sprachen:</b>
                        </div>
                        <div class="col-md-9">
                            {{ $trainer->languages }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <b>Lieblingstechnik:</b>
                        </div>
                        <div class="col-md-9">
                            {{ $trainer->fav_technique }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <b>Sonstiges:</b>
                        </div>
                        <div class="col-md-9">
                            {{ $trainer->misc }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2"></div>
</div>
<?php } ?>
<?php echo view('foot'); ?>
<style>
    @media (max-width: 768px) {
        h3 {
        text-align: center;
    }
        .trainer-photo {
            text-align:center;
        }
    }
    h3 {
        padding-top: 0px;
        margin-top: 0px;
    }
</style>
