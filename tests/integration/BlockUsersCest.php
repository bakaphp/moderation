<?php

declare(strict_types=1);

namespace Kanvas\Moderation\Tests\Integration;

use IntegrationTester;
use Kanvas\Moderation\BlockUsers;
use Kanvas\Moderation\Models\BlockedUsers;
use Kanvas\Moderation\Tests\Support\Models\Apps as ModelsApps;
use Kanvas\Moderation\Tests\Support\Models\Users;

class BlockUsersCest
{
    public function testBlockUser(IntegrationTester $I) : void
    {
        $user = new Users();
        $user->id = rand(2, 100);
        $app = new ModelsApps();

        $blockUser = BlockUsers::block($I->grabDi()->get('userData'), $user, $app);

        $I->assertEquals($I->grabDi()->get('userData')->getId(), $blockUser->users_id);
        $I->assertEquals($user->getId(), $blockUser->blocked_users_id);
        $I->assertFalse((bool) $blockUser->is_deleted);
    }

    public function testUnblockUser(IntegrationTester $I) : void
    {
        $blockedUser = BlockedUsers::findFirst('is_deleted = 0');
        $user = new Users();
        $user->id = $blockedUser->blocked_users_id;

        $response = BlockUsers::unBlock($I->grabDi()->get('userData'),$user);

        $I->assertTrue(true, $response->is_deleted);
    }

    public function testIsBlockedTrue(IntegrationTester $I) : void
    {
        $this->generateBlockedUser();

        $blockedUser = BlockedUsers::findFirst('is_deleted = 0');

        $user = new Users();
        $user->id = $blockedUser->blocked_users_id;

        $response = BlockUsers::isBlocked($I->grabDi()->get('userData'),$user);

        $I->assertTrue( $response);
    }

    public function testIsBlockedFalse(IntegrationTester $I) : void
    {
        $blockedUser = BlockedUsers::findFirst('is_deleted = 1');
        $user = new Users();
        $user->id = $blockedUser->blocked_users_id;

        $response = BlockUsers::isBlocked($I->grabDi()->get('userData'),$user);

        $I->assertFalse( $response);
    }

    public function generateBlockedUser() : void
    {
        $blockedUser = new BlockedUsers();
        $blockedUser->users_id = 1;
        $blockedUser->blocked_users_id = rand(2, 100);
        $blockedUser->apps_id = 1;
        $blockedUser->saveOrFail(); 
    }

}
