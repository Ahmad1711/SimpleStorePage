<?php


namespace App\Classes;

use App\Interfaces\SMSInterface;

class FirstSms implements SMSInterface{

    public function send()
    {
        return 'FirstSms';
    }
}