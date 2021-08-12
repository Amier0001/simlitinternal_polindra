<?php

function time_format($time)
{
    $fetch = explode(' ', $time);
    $chunks = explode(':', $fetch[1]);

    if ($fetch[2] == 'AM' && $chunks[0] != '12') {
        $chunks[0] = $chunks[0];
    } else if ($fetch[2] == 'AM' && $chunks[0] == '12') {
        $chunks[0] = '00';
    } else if ($fetch[2] == 'PM' && $chunks[0] != '12') {
        $chunks[0] = $chunks[0] + 12;
    } else if ($fetch[2] == 'PM' && $chunks[0] == '12') {
        $chunks[0] = '12';
    }

    return implode(':', $chunks);
}

function flip_dateformat($date)
{
    $fetch = explode('/', $date);

    return $fetch[2] . '-' . $fetch[1] . '-' . $fetch[0];
}
