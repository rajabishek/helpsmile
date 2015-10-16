<?php namespace Helpsmile\Services\Forms;

class SettingsForm extends FormValidator{

    /**
     * The validation rules to validate the input data against.
     *
     * @var array
     */
    protected $rules = [
    	'fullname' => 'required',
    	'mobile' => 'numeric|digits:10'
    ];

    /**
     * Validate the form data
     *
     * @param  mixed $formData
     * @return mixed
     * @throws FormValidationException
     */
    public function validate($formData){

        $this->rules['mobile'] = "numeric|digits:10|unique:users,mobile,{$formData['id']}";
        //Validate the form data
        parent::validate($formData);
    }
}
