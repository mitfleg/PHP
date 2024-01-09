<?php

namespace Controller;

use Contracts\ReaderContract;
use Http\Request;
use Http\Response;
use Service\ReaderService;

class ReaderController extends BaseController
{
    public static function addReader(Request $req, Response $resp): void
    {
        /**
         * @var ReaderContract
         */
        $reqData = $req->validateAndGet(new ReaderContract());
        $manager = new ReaderService();
        $reader_id = $manager->addReader($reqData->name);
        $resp->success(['id' => $reader_id]);
    }

}
