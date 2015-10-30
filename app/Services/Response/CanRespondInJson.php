<?php 

namespace Helpsmile\Services\Response;

use Illuminate\Http\Response as ResponseCode;

trait CanRespondInJson {

    /**
     * Set the status code for the reponse
     * 
     * @param interger $statusCode
     * @return \Controllers\Api\v1\ApiController $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * Get the status code for the response
     * 
     * @return interger
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function respondNotFound($errors = 'Not Found.')
    {
        return $this->setStatusCode(ResponseCode::HTTP_NOT_FOUND)->respondWithError($errors);
    }

    public function respondInternalError($errors = 'An unknown error occured, try sometime later.')
    {
        return $this->setStatusCode(ResponseCode::HTTP_INTERNAL_SERVER_ERROR)->respondWithError($errors);
    }

    public function respondBadRequest($errors)
    {
        return $this->setStatusCode(ResponseCode::HTTP_BAD_REQUEST)->respondWithError($errors);
    }

    public function respondUnauthorizedRequest($errors)
    {
        return $this->setStatusCode(ResponseCode::HTTP_UNAUTHORIZED)->respondWithError($errors);
    }

    public function respondForbidden($errors = "You don't have permissions to access this."){
        
        return $this->setStatusCode(ResponseCode::HTTP_FORBIDDEN)->respondWithError($errors);
    }

    public function respondWithError($errors)
    {
        $errors = is_string($errors) ? [$errors] : $errors;
        
        return $this->respond([
            'success' => false,
            'errors' => $errors
        ]);
    }

    /**
     * Return the json response with the given status code
     *
     * @param  array $data
     * @param integer $statusCode 
     * @return \Illuminate\Http\Response
     */
    public function respond($data,$headers = [])
    {
        return response()->json($data,$this->getStatusCode(),$headers);
    }
}