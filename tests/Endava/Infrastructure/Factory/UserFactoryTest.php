<?php
/**
 * Created by PhpStorm.
 * User: aisacescu
 * Date: 2/16/2018
 * Time: 6:04 PM
 */

namespace TestEndava\Infrastructure\Factory;

use Endava\Domain\Model\User;
use Endava\Domain\ValueObject\UserName;
use Endava\Infrastructure\Factory\UserFactory;
use TestEndava\AbstractTestCase;

class UserFactoryTest extends AbstractTestCase
{

    private $userFactory;

    public function setUp()
    {
        parent::setUp();
        $this->userFactory = new UserFactory();
    }

    public function testCreateFromCreateRequest()
    {
        $createUserRequestObject = $this->getCreateUserRequestObject();
        $user                    = $this->userFactory->createFromCreateRequest($createUserRequestObject);
        $this->assertInstanceOf(User::class, $user);
    }

    public function testCreateFromUpdateRequest()
    {
        $createUserRequestObject = $this->getCreateUserRequestObject();
        $user                    = $this->userFactory->createFromCreateRequest($createUserRequestObject);
        $updateUserRequestObject = $this->getUpdateUserRequestObject($user->getUserId()->getUserId());
        $userUpdated             = $this->userFactory->createFromUpdateRequest($updateUserRequestObject);
        $this->assertTrue($userUpdated->getUserName()->equals(new UserName(self::SECOND_USER_NAME)));
    }
}
