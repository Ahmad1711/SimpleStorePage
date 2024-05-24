<?php


namespace App\Classes;

use App\Interfaces\SMSInterface;

class SecondSms implements SMSInterface{

    public function send()
    {
        return 'SecondSms';
    }
}