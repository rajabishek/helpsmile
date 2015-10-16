<?php namespace Helpsmile\Services\Forms;

class DonorUpdateForm extends FormValidator{

    /**
     * The validation rules to validate the input data against.
     *
     * @var array
     */
    protected $rules = [
        'fullname'  => 'required',
        'mobile'  => 'required|unique:donors',
        'email'  => 'required|email',
    ];

    /**
     * @param int $id
     * @param array $input
     * @return mixed
     */
    public function validate($input)
    {
        $this->rules['email'] = "required|email|unique:donors,email,{$input['id']}";
        $this->rules['mobile'] = "required|unique:donors,mobile,{$input['id']}";        
        
        parent::validate($input);
    }
}
