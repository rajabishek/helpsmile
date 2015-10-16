<?php namespace Helpsmile\Services\Forms;

class DonationCompletionForm extends FormValidator{

    /**
     * The validation rules to validate the input data against.
     *
     * @var array
     */
    protected $rules = [
        'status'  => 'required|in:donated,disinterested'
    ];

    /**
     * @param int $id
     * @param array $formData
     * @return mixed
     */
    public function validate($formData)
    {
        if($formData['status'] == 'donated')
            $this->rules['donated_amount'] = "required|numeric";

        parent::validate($formData);
    }
}
