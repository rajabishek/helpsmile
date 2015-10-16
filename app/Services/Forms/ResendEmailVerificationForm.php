<?php namespace Helpsmile\Services\Forms;

class ResendEmailVerificationForm extends FormValidator{

    /**
     * The validation rules to validate the input data against.
     *
     * @var array
     */
    protected $rules = [
    	'domain' => 'required|alpha_num|max:20|exists:organisations,domain',
        'email'  => 'required|email',
    ];
}
