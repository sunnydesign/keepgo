<?php

namespace App\Services;

use App\Models\SimCard;
use Illuminate\Support\Facades\Log;

class SendSms
{

    /**
     * @param SimCard $simCard
     * @param string $message
     *
     * @return bool[]
     */
    public function send(SimCard $simCard, string $message): array
    {
        // do something

        $response = [
            'result' => true,
            'simcard' => $simCard->iccid,
            'message' => $message
        ];

        Log::debug(json_encode($response));

        return $response;
    }

}
