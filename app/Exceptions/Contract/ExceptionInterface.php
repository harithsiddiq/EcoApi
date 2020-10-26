<?php


namespace App\Exceptions\Contract;


interface ExceptionInterface
{

    public function apiException();
    public function isModel();
    public function isHttps();
    public function ModelResponse();
    public function HttpResponse();


}
