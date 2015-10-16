<?php namespace Helpsmile\Services\Forms;

class WebhookUpdateForm extends FormValidator{

    /**
     * The validation rules to validate the input data against.
     *
     * @var array
     */
    protected $rules = [
        'url'  => 'required|url|unique:webhooks,url',
    ];

    /**
     * @param int $id
     * @param array $input
     * @return mixed
     */
    public function validate($input)
    {
        $this->rules['url'] = "required|url|unique:webhooks,url,{$input['id']}";

        parent::validate($input);
    }
}
