<?php namespace Helpsmile\Services\Forms;

class AddEmployeeForm extends FormValidator{

    /**
     * The validation rules to validate the input data against.
     *
     * @var array
     */
    protected $rules = [
        'email'  => 'required|email|unique:users',
        'fullname'  => 'required',
        'password' => 'required|min:5|confirmed',
        'password_confirmation' => 'required'
    ];

    /**
     * Validate the form data
     *
     * @param  mixed $formData
     * @return mixed
     * @throws FormValidationException
     */
    public function validate($formData)
    {
        $roles = ['Telecaller','Team Leader','Field Executive','Field Coordinator','Manager'];
        $roles = implode(',', $roles);
        $this->rules['designation'] = "required|in:$roles";

        if($formData['mobile'])
            $this->rules['mobile'] = 'required|numeric|digits:10|unique:users';

        //Validate the form data
        parent::validate($formData);
    }
}
