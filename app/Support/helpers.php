<?php

use Carbon\Carbon;

function dateFormatting($object)
{
    $date =  $object->updated_at->diffInWeeks(Carbon::now()) >= 1
        ? $object->updated_at->format('M j, Y') : $object->updated_at->diffForHumans(null, true, true);

    return $date;

}

function dateFormattingWithTime($object)
{
    return $object->updated_at->format('g:ia - M j, Y');

}

