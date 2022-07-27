<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CustomerNotificationResource;
use Notification;

class NotificationController extends ApiBaseController
{
    public function getCustomerNotifications()
    {
        return CustomerNotificationResource::collection(auth()->user()->unreadNotifications);
    }

    public function markAsRead($notificationId)
    {
        $notification = auth()->user()->notifications()->where('id', $notificationId)->first();
        $notification->markAsRead();

        return $this->sendResponse(['unread_count' => auth()->user()->unreadNotifications()->count()],
        'Notification cleared');
    }
}
