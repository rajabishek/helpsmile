<?php namespace Helpsmile\Services\Forms;

class RegistrationForm extends FormValidator{

    /**
     * The validation rules to validate the input data against.
     *
     * @var array
     */
    protected $rules = [
        'email'  => 'required|email|unique:users',
        'fullname'  => 'required',
        'password' => 'required|confirmed',
        'password_confirmation' => 'required',
        'name' => 'required',
        'domain' => 'required|alpha_num|max:20|unique:organisations,domain'
    ];
}
