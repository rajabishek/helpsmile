<?php namespace Helpsmile\Services\Forms;

class UnassignedDonationUpdateForm extends FormValidator{

    /**
     * The validation rules to validate the input data against.
     *
     * @var array
     */
    protected $rules = [
        'promised_amount'  => 'required',
        'telecaller_id' => 'required',
        'appointment' => 'required',
        'address' => 'required',
        'location' => 'required',
        'latitude' => 'required',
        'longitude' => 'required'
    ];

    /**
     * custom validation messages
     *
     * @var array
     */
    protected $messages = [
        'location.required' => "Please mark the donor's nearby location on the map",
    ];
}
