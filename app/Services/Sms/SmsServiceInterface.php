<?php
namespace App\Services\Sms;

/**
 * Created by PhpStorm.
 * User: faridcs
 * Date: 1/6/18
 * Time: 2:00 PM
 */

interface SmsServiceInterface
{
    /**
     * @param string $recipients
     * @param string $text
     * @return mixed
     */
    public function sendSms(string $recipients , string $text);
}