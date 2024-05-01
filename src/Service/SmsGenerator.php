<?php
namespace App\Service;

use Twilio\Rest\Client;

class SmsGenerator
{
    
    
          public function SendSms(string $number, string $name, string $text)
    {
        
        $accountSid ='AC7f42e1dfeb9bfc83506676b133dd09c6';  //Identifiant du compte twilio
        $authToken ='1052fc23b9c0561ab209cd0616c69168'; //Token d'authentification
        $fromNumber ='+12196820814'; // Numéro de test d'envoie sms offert par twilio

        $toNumber = $number; // Le numéro de la personne qui reçoit le message
        $message = ''.$name.' vous a envoyé le message suivant:'.' '.$text.''; //Contruction du sms

        //Client Twilio pour la création et l'envoie du sms
        $client = new Client($accountSid, $authToken);

        $client->messages->create(
            $toNumber,
            [
                'from' => $fromNumber,
                'body' => $message,
            ]
        );


    }




}