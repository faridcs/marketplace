<?php
/**
 * Created by PhpStorm.
 * User: faridcs
 * Date: 1/6/18
 * Time: 1:17 PM
 */

namespace App\Listeners;

use App\Events\SendInvitationToGroup;
use App\Events\SendRecoveryPassword;
use App\Events\SendVerificationCode;
use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Jobs\Sms\SendSmsJob;
use Lang;

class UserEventListener
{
    use DispatchesJobs;

    /**
     * @param $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'App\Events\SendVerificationCode',
            'App\Listeners\UserEventListener@onSendVerificationCode'
        );

        $events->listen(
            'App\Events\SendRecoveryPassword',
            'App\Listeners\UserEventListener@onSendRecoveryPassword'
        );

        $events->listen(
            'App\Events\SendInvitationToGroup',
            'App\Listeners\UserEventListener@onSendInvitationToGroup'
        );
    }

    public function onSendInvitationToGroup(SendInvitationToGroup $event)
    {
        $users = $event->getUsers();
        $group = $event->getGroup();

        $text = Lang::get("sms.invitation", ['groupTitle' => $group->title], 'fa');
        $this->dispatch(new SendSmsJob($users, $text));
    }


    public function onSendVerificationCode(SendVerificationCode $event)
    {
        $user = $event->getUser();
        $verifyCode = $event->getVerifyCode();

        $text = Lang::get("sms.verify", ['verificationCode' => $verifyCode], 'fa');
        $this->dispatch(new SendSmsJob($user->mobile, $text));
    }

    public function onSendRecoveryPassword(SendRecoveryPassword $event)
    {
        $user = $event->getUser();
        $password = $event->getPassword();

        $text = Lang::get("sms.password", ['password' => $password], 'fa');
        $this->dispatch(new SendSmsJob($user->mobile, $text));
    }

}