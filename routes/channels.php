<?php

use Illuminate\Support\Facades\Broadcast;


Broadcast::channel('chat', \App\Broadcasting\ChatChannel::class);
