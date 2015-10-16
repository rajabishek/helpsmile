<?php namespace Helpsmile\Transformers;

use Carbon\Carbon;

class DonationTransformer extends Transformer{

    /**
     * Transform the given donation
     *
     * @param array $donation
     * @return array
     */
    public function transform($donation){
        
        $response = [
            'id' => intval($donation['id']),
            'fullname' => $donation['donor']['fullname'],
            'email' => $donation['donor']['email'],
            'mobile' => $donation['donor']['mobile'],
            'status' => $donation['status'],
            'promised_amount' => intval($donation['promised_amount']),
            'appointment' => $donation['appointment'],
            'latitude' => floatval($donation['address']['latitude']),
            'longitude' => floatval($donation['address']['longitude']),
            'address' => $donation['address']['address'],
            'donated_amount' => intval($donation['donated_amount']),
            'donated_at' => $donation['donated_at'] ? $donation['donated_at']->toDateTimeString() : null,
            'cancelled_at' => $donation['cancelled_at'] ? $donation['cancelled_at']->toDateTimeString() : null
        ];

        return $response;
    }
	
}