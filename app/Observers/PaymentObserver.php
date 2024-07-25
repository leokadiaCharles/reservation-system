<?php

namespace App\Observers;

use App\Models\payement;

use Emanate\BeemSms\Facades\BeemSms;

class PaymentObserver
{

public function created(payement $payement): void
{
    BeemSms::content("Successful your $payement->amount, are confirmed")
    ->unpackRecipients($payement->phoneNumber)
    ->send();
   
}
}
