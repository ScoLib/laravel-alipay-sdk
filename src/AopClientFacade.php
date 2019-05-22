<?php

namespace Sco\LaravelEasySms;

use Alipay\AopClient;
use Illuminate\Support\Facades\Facade;

class AopClientFacade extends Facade
{
    /**
     * @inheritDoc
     */
    protected static function getFacadeAccessor()
    {
        return AopClient::class;
    }
}
