<?php


namespace App\Exceptions;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait ExceptionTrait
{

    public function apiException($e, $request){

        if ($this->isModel($e)) {
            return $this->ModelResponse();
        }

        if ($this->isHttps($e)) {
            return $this->HttpResponse();
        }

        return parent::render($request, $e);
    }


    private function isModel($e){
        return $e instanceof ModelNotFoundException;
    }

    private function isHttps($e){
        return $e instanceof NotFoundHttpException;
    }

    private function ModelResponse()
    {
        return response()->json([
            'error' => 'Model Not Found'
        ], Response::HTTP_NOT_FOUND);
    }

    private function HttpResponse()
    {
        return response()->json([
            'error' => 'Incorrect route'
        ], Response::HTTP_NOT_FOUND);
    }

}
