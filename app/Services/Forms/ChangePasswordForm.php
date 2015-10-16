<?php namespace Helpsmile\Services\Forms;

class ChangePasswordForm extends FormValidator{
 
    /**
     * Validation rules for logging in
     *
     * @var array
     */
    protected $rules = [
        'old_password' => 'required|min:5', 
        'password' => 'required|min:5|confirmed',
    ];
}
