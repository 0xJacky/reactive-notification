<?php

namespace Digitalcloud\ReactiveNotification\Models;

class DatabaseNotification extends \Illuminate\Notifications\DatabaseNotification
{
    protected $hidden = ['notifiable', 'serialized'];
    
    public function getDataAttribute()
    {  
        if (isset($this->attributes['data'])) {
            $data = json_decode($this->attributes['data'], true);

            if (isset($this->attributes['serialized']) && $this->attributes['serialized']) {
                $obj = unserialize($data['data']);
                /*if (method_exists($obj, 'toDatabase')) {
                    return $obj->toDatabase($this->notifiable);
                } else {
                    return $obj->toArray($this->notifiable);
                }*/
                return $obj->toDatabase($this->notifiable);
            } else {
                return $data;
            }
        }

        return [];
    }
}
