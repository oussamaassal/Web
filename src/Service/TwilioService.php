<?php

namespace App\Service;

use Twilio\Rest\Client;

class TwilioService
{
    private $accountSid = 'AC5bc580ea6b3b2aee76723258977dfd6a';
    private $authToken = 'ccccc';
    private $twilioPhoneNumber = '+17744257047';

    public function sendSMS()
    {
        $to = '+21623990938'; // Le numÃ©ro de tÃ©lÃ©phone destinataire
        $message = 'you added an election .'; // Le message que vous souhaitez envoyer
        $client = new Client($this->accountSid, $this->authToken);
        $client->messages->create(
            $to,
            [
                'from' => $this->twilioPhoneNumber,
                'body' => $message,
            ]
        );
    }
}