<?php namespace Helpsmile\Services\Forms;

class DonorDonationCreationForm extends FormValidator{

    /**
     * The validation rules to validate the input data against.
     *
     * @var array
     */
    protected $rules = [
        'fullname'  => 'required',
        'email'  => 'required|email|unique:donors',
        'mobile'  => 'required|numeric|digits:10|unique:donors',
        'promised_amount'  => 'required|numeric|min:0',
        'telecaller_id' => 'required',
        'appointment' => 'required',
        'address' => 'required',
        'location' => 'required',
        'latitude' => 'required',
        'longitude' => 'required',
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
