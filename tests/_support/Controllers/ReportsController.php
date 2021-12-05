<?php

declare(strict_types=1);

namespace Kanvas\Moderation\Tests\Support\Controllers;

use Baka\Contracts\Database\ModelInterface;
use Baka\Contracts\Http\Api\ResponseTrait;
use Kanvas\Moderation\Traits\ReportableRoutes;
use Phalcon\Di\Injectable;
use Phalcon\Http\RequestInterface;
use Phalcon\Http\ResponseInterface;

class ReportsController extends Injectable
{
    use ResponseTrait;
    use ReportableRoutes;

    protected ?ModelInterface $model = null;
    protected RequestInterface $request;
    protected ResponseInterface $response;

    public function __construct()
    {
        $this->onConstruct();
        $this->request = $this->getDI()->get('request');
        $this->response = $this->getDI()->get('response');
    }
}
