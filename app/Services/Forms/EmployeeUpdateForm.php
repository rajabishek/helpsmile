<?php namespace Helpsmile\Services\Forms;

class EmployeeUpdateForm extends FormValidator{

    /**
     * The validation rules to validate the input data against.
     *
     * @var array
     */
    protected $rules = [
        'email'  => 'required|email',
        'fullname'  => 'required',
        'designation' => 'required',
    ];

    /**
     * @param int $id
     * @param array $formData
     * @return mixed
     */
    public function validate($formData)
    {
        $this->rules['email'] = "required|email|unique:users,email,{$formData['id']}";
        $this->rules['mobile'] = "unique:users,mobile,{$formData['id']}";
        
        if(isset($formData['password']) && $formData['password'])
            $this->rules['password'] = 'required|confirmed';

        parent::validate($formData);
    }
}
