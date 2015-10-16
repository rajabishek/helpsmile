<?php namespace Helpsmile\Services\Forms;

class WebhookCreationForm extends FormValidator{

    /**
     * The validation rules to validate the input data against.
     *
     * @var array
     */
    protected $rules = [
        'url'  => 'required|url|unique:webhooks,url',
    ];
}
