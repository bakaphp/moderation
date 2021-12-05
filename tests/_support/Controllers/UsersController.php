<?php

declare(strict_types=1);

namespace Kanvas\Moderation\Tests\Support\Controllers;

use Baka\Contracts\Database\ModelInterface;
use Baka\Contracts\Http\Api\ResponseTrait;
use Kanvas\Moderation\Traits\BlockedUserRoutes;
use Phalcon\Di\Injectable;
use Phalcon\Http\RequestInterface;
use Phalcon\Http\ResponseInterface;

class UsersController extends Injectable
{
    use ResponseTrait;
    use BlockedUserRoutes;

    protected ?ModelInterface $model = null;
    protected RequestInterface $request;
    protected ResponseInterface $response;
    protected $customColumns;
    protected $customTableJoins;
    protected $customLimit;
    protected $customConditions;
    protected $customSort;
    protected array $additionalCustomSearchFields = [];
    protected array $additionalRelationSearchFields = [];

    public function __construct()
    {
        $this->onConstruct();
        $this->request = $this->getDI()->get('request');
        $this->response = $this->getDI()->get('response');
    }
}
