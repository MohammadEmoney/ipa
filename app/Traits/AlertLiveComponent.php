<?php

namespace App\Traits;

use App\Services\Alert;

trait AlertLiveComponent
{
    protected function alert( string $message, string $title = null)
    {
        $title = is_null($title) ? ($this->ngTitle??'') : $title;
        return new Alert($this,$message,$title);
    }
}
