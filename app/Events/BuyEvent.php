<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class BuyEvent
{
    use SerializesModels;


    public function take()
    {
        dd(time());
    }



}
