<?php
/**
 * Created by PhpStorm.
 * User: faridcs
 * Date: 1/6/18
 * Time: 1:27 PM
 */

namespace App\Jobs\Sms;

use App\Services\Sms\SmsServiceInterface;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Log;

class SendSmsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var array
     */
    protected $recipients;

    /**
     * @var array
     */
    protected $text;

    /**
     * SendSmsJob constructor.
     * @param string $recipients
     * @param string $text
     */
    public function __construct(string $recipients, string $text)
    {
        $this->recipients = $recipients;
        $this->text = $text;
    }

    public function handle(SmsServiceInterface $smsService)
    {
        try {
            $smsService->sendSms($this->recipients, $this->text);
            Log::info('SMS was sent successfully', [
                'recipients' => $this->recipients,
                'text' => $this->text,
            ]);
        } catch (Exception $e) {
            Log::notice('Cannot send SMS', [
                'recipients' => $this->recipients,
                'text' => $this->text,
                'attempts' => $this->job->attempts(),
                'error' => $e->getMessage()
            ]);

            if ($this->attempts() <= 3) {
                $this->release(60);
            } else {
                Log::error('Cannot send SMS after 4 attempts', [
                    'recipients' => $this->recipients,
                    'text' => $this->text,
                    'attempts' => $this->job->attempts(),
                    'error' => $e->getMessage()
                ]);
            }
        }
    }

}