<?php namespace Helpsmile\Transformers;

use Carbon\Carbon;

class NotificationTransformer extends Transformer{

    /**
     * Transform the given notification
     *
     * @param array $notification
     * @return array
     */
    public function transform($notification)
    {
        return [
            'title' => $notification['title'],
            'description' => $notification['description'],
            'type' => $notification['type'],
            'happened_at' => (new Carbon($notification['happened_at']))->diffForHumans()
        ];
    }	
}