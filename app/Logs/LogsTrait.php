<?php 

namespace App\Logs;

use App\Events\LogEvent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;


trait LogsTrait {

    protected static function bootLogsTrait()
    {
        foreach(static::getModelEvents() as $eventName) {
            static::$eventName(function(Model $model) use ($eventName) {
                try {
                    event(new LogEvent($eventName, $model, static::getPropertyToShow()));
                } catch(\Exception $ex) {
                    return true;
                }
            });
        }
    }

    protected static function getModelEvents() 
    {
        if(isset(static::$recordEvents)) {
            return static::$recordEvents;
        }

        return [
            'created',
            'updated',
            'deleted'
        ];
    }

    protected static function getPropertyToShow() 
    {
        if(isset(static::$propertyLogsToShow)) return static::$propertyLogsToShow;
    }
}