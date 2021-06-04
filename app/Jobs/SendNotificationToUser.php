<?php

namespace App\Jobs;

use App\Facades\FCMFacade;
use App\Models\NotificationUser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendNotificationToUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    public $timeout = 2 * 60;

    protected $notificationUser;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(NotificationUser $notificationUser)
    {
        $this->notificationUser = $notificationUser;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $deviceToken = $this->notificationUser->deviceToken;
            $result = FCMFacade::sendNotification(
                $deviceToken->device_token,
                $this->notificationUser->title,
                $this->notificationUser->short_body,
                $this->notificationUser->toArray(), null, $deviceToken->device_type, 'default', $this->timeout);
            Log::channel('command_errors')->info(__CLASS__ . "@" . __FUNCTION__ . "--- SendNotificationToUser - Push success " . $result);
        } catch (\Exception $e) {
            Log::channel('command_errors')->debug(__CLASS__ . "@" . __FUNCTION__ . "--- SendNotificationToUser - Push error " . json_encode($e));
        }
    }
}
