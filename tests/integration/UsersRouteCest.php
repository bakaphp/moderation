<?php

declare(strict_types=1);

namespace Kanvas\Moderation\Tests\Integration;

use Baka\Http\Exception\BadRequestException;
use Canvas\Models\Users;
use IntegrationTester;
use Kanvas\Moderation\Tests\Support\Controllers\UsersController;

class UsersRouteCest
{
    public function testBockUsers(IntegrationTester $I) : void
    {
        $user = Users::findFirst('id > 1');
        $userController = new UsersController();
        $response = $userController->blockUser($user->getId());
        $content = json_decode($response->getContent(), true);

        $I->assertEquals(200, $response->getStatusCode());
        $I->assertEquals($user->getId(), $content['blocked_users_id']);
    }

    public function testCantBlockMyself(IntegrationTester $I) : void
    {
        $user = Users::findFirst($I->grabDi()->get('userData')->getId());
        $userController = new UsersController();

        try {
            $response = $userController->blockUser($user->getId());
            $content = json_decode($response->getContent(), true);
        } catch (BadRequestException $e) {
            $I->assertEquals('You can not block yourself', $e->getMessage());
        }
    }
}
