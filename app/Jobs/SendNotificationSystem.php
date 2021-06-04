<?php

namespace App\Jobs;

use App\Models\DeviceToken;
use App\Models\Notification;
use App\Models\NotificationUser;
use App\Models\User;
use App\Repositories\Facades\NotificationRepository;
use App\Repositories\Facades\NotificationUserRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendNotificationSystem implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $notificationId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($notificationId)
    {
        $this->notificationId = $notificationId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $notificationId = $this->notificationId;
            $notification = NotificationRepository::findOrFail($notificationId);

            $deviceTokens = DeviceToken::query()->whereDoesntHave('notificationUsers', function ($q) use ($notificationId) {
                $q->where('notification_id', $notificationId);
            })->take(100)->get();
            if (!empty($deviceTokens->toArray())) {
                foreach ($deviceTokens as $key => $item){
                    $notificationUser = NotificationUserRepository::create([
                        'image' => $notification->image,
                        'image_thumbnail' => $notification->image_thumbnail,
                        'title' => $notification->title,
                        'short_body' => $notification->short_body,
                        'body' => $notification->body,
                        'resource_id' => $notification->id,
                        'resource_table' => 'notifications',
                        'notification_id' => $notificationId,
                        'user_id' => $item->user_id,
                        'device_token_id' => $item->id,
                    ]);
                    SendNotificationToUser::dispatch($notificationUser);
                }
                SendNotificationSystem::dispatch($notificationId);
            }
        } catch (\Exception $e) {
            Log::channel('command_errors')->debug(__CLASS__ . "@" . __FUNCTION__ . "--- SendNotificationSystem - Push error " .json_encode($e));
        }
    }
}
