<?php

/**
 * Created by PhpStorm.
 * User: faridcs
 * Date: 1/6/18
 * Time: 1:02 PM
 */
namespace App\Events;

use Illuminate\Queue\SerializesModels;

abstract class Event
{
    use SerializesModels;
}