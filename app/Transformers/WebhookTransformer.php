<?php namespace Helpsmile\Transformers;

class WebhookTransformer extends Transformer{

    /**
     * Transform the given webhook
     *
     * @param array $webhook
     * @return array
     */
    public function transform($webhook){

        return [   
            'id' => intval($webhook['id']),
            'url' => $webhook['url'],
        ];
    }
	
}