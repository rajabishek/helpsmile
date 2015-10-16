<?php namespace Helpsmile\Transformers;

class UserTransformer extends Transformer{

    /**
     * Transform the given user
     *
     * @param array $user
     * @return array
     */
    public function transform($user){

        return [
            'id' => intval($user['id']),
            'email' => $user['email'],
            'fullname' => $user['fullname'],
            'address' => $user['address'],
            'mobile' => $user['mobile'],
            'designation' => $user['designation']
        ];
    }
	
}