<?php
/**
 * Created by PhpStorm.
 * User: faridcs
 * Date: 6/12/18
 * Time: 12:24 PM
 */

namespace App\Events;

use App\Models\User;

class SendRecoveryPassword extends Event
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var
     */
    private $password;

    /**
     * SendRecoveryPassword constructor.
     * @param User $user
     * @param int $password
     */
    public function __construct(User $user, int $password)
    {
        $this->user = $user;
        $this->password = $password;
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
    public function getPassword()
    {
        return $this->password;
    }
}