<?php
namespace App\Services;

use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

class FCMService
{
    public function sendNotification($token, $title, $body, $data = [], $badge = 0, $os = 'android', $sound = 'default', $timeToLive = 60 * 20) {
        $optionBuilder = new OptionsBuilder();
        $optionBuilder->setTimeToLive($timeToLive);
        if (isset($data['collapse_key'])) {
            $optionBuilder->setCollapseKey($data['collapse_key']);
        }
        $option = $optionBuilder->build();

        $notificationBuilder = new PayloadNotificationBuilder($title);
        $notificationBuilder->setBody($body)
            ->setSound($sound);
        if(!empty($badge)){
            $notificationBuilder->setBadge($badge);
        }
        $notification = $notificationBuilder->build();

        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData($data);
        $data = $dataBuilder->build();

        $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
        return [
            'numberSuccess' => $downstreamResponse->numberSuccess(),
            'numberFailure' => $downstreamResponse->numberFailure(),
            'numberModification' => $downstreamResponse->numberModification()
        ];
    }
}
