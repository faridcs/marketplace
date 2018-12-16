<?php
/**
 * Created by PhpStorm.
 * User: faridcs
 * Date: 2/11/18
 * Time: 11:07 PM
 */

namespace App\Events;

use App\Models\User;

class SendVerificationCode extends Event
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var int
     */
    private $verifyCode;

    /**
     * SendVerificationCode constructor.
     * @param User $user
     * @param int $verifyCode
     */
    public function __construct(User $user, int $verifyCode)
    {
        $this->user = $user;
        $this->verifyCode = $verifyCode;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return mixed
     */
    public function getVerifyCode()
    {
        return $this->verifyCode;
    }
}