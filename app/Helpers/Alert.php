<?php

use Illuminate\Support\Facades\Session;

function flash_alert($icon, $alert, $subalert)
{
    Session::flash('icon', $icon);
    Session::flash('alert', $alert);
    Session::flash('subalert', $subalert);
}
