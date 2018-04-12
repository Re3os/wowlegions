<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailOrderShop extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $price;
    public $code;

    public function __construct($name, $price, $code)
    {
        $this->product = $name;
        $this->price = $price;
        $this->code = $code;
    }

    public function build()
    {
        return $this->from('robot@wowlegions.ru')->view('mail.order')->with([
        'product' => $this->product,
        'price' => $this->price,
        'code' => $this->code
        ])->subject('Спасибо за покупку');
    }
}
