<?php
namespace App\Services\Sms;

use Exception;
use HttpException;
use Kavenegar\Exceptions\ApiException;
use Kavenegar\KavenegarApi;

/**
 * Created by PhpStorm.
 * User: faridcs
 * Date: 1/6/18
 * Time: 2:03 PM
 */
class SmsService implements SmsServiceInterface
{
    private $secretApi;
    private $sender;
    private $smsApi;

    /**
     * SmsService constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $this->secretApi = env("KAVENEGAR_SECRET", "");
        $this->smsApi = new KavenegarApi($this->secretApi);
    }

    /**
     * @param string $recipients
     * @param string $text
     * @return bool|mixed
     */
    public function sendSms(string $recipients, string $text)
    {
        try {
            $this->smsApi->Send($this->sender,$recipients,$text);
        } catch(ApiException $exception) {
            echo $exception->errorMessage();
        } catch(HttpException $exception) {
            echo $exception->getMessage();
        }
    }
}