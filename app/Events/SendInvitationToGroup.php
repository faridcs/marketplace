<?php

namespace App\Events;

use App\Models\Group;

class SendInvitationToGroup extends Event
{
    /**
     * @var $users
     */
    private $users;

    /**
     * @var $group
     */
    private $group;

    /**
     * SendInvitationToGroup constructor.
     * @param String $users
     * @param Group $group
     */
    public function __construct(String $users, Group $group)
    {
        $this->users = $users;
        $this->group = $group;
    }

    /**
     * @return mixed
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @return mixed
     */
    public function getGroup()
    {
        return $this->group;
    }

}