<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

use Illuminate\Database\Eloquent\Model;

class LogEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    private $model;
    private $className;
    private $propertyName;

    public function __construct($methodName, $model, $propertyName = null)
    {
        $this->className = class_basename($model);
        $this->model = $model;
        $this->propertyName = $propertyName;

        $this->{$methodName}();
    }

    public function created() 
    {
        activity()->log($this->className . ' baru telah ditambahkan');
    }

    public function updated() 
    {
        $updatedName = $this->model->nama ?? $this->className;

        activity()->log('Data ' . $this->className . ' ' . $this->model->{$this->propertyName} .  ' telah di modifikasi');
    }

    public function deleted() 
    {
        activity()->log($this->className . ' ' . $this->model->{$this->propertyName} . ' telah dihapus');
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
