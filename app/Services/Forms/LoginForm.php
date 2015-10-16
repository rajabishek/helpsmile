<?php namespace Helpsmile\Services\Forms;

class LoginForm extends FormValidator{

    /**
     * The validation rules to validate the input data against.
     *
     * @var array
     */
    protected $rules = [
        'email'  => 'required|email',
        'password'  => 'required|min:5'
    ];
}
