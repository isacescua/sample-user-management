<?php
/**
 * Created by PhpStorm.
 * User: aisacescu
 * Date: 2/20/2018
 * Time: 8:07 AM
 */

namespace TestEndava;


use Endava\Application\Request\CreateUserRequest;
use Endava\Application\Request\UpdateUserRequest;
use Endava\Domain\Model\User;
use Endava\Domain\ValueObject\CreateUserRequestObject;
use Endava\Domain\ValueObject\UpdateUserRequestObject;
use Endava\Domain\ValueObject\UserEmail;
use Endava\Domain\ValueObject\UserId;
use Endava\Domain\ValueObject\UserName;
use Endava\Domain\ValueObject\UserPassword;
use PHPUnit\Framework\TestCase;
use TestEndava\Domain\Service\UserServiceTest;
use TestEndava\Infrastructure\PasswordEncodingStrategies\MockPasswordEncodingStrategy;

class AbstractTestCase extends TestCase
{
    const USER_ID = 'SAMPLE';
    const USER_NAME = 'Andrei';
    const USER_EMAIL = 'andrei.isacescu@endava.com';
    const USER_PASSWORD = 'myPassword';

    const SECOND_USER_NAME = 'Isacescu';
    const SECOND_USER_EMAIL = 'isacescu@endava.com';
    const SECOND_USER_PASSWORD = 'secondPassword';

    const INVALID_EMAIL_ADDRESS = 'invalid';
    const SMALL_PASSWORD = 'test';

    const EMPTY_EMAIL = '';
    const EMPTY_USER_ID = '';
    const EMPTY_USER_NAME = '';
    const EMPTY_PASSWORD = '';

    /**
     * return User
     * @param UserId|null $uid
     * @return User
     */
    protected function createDefaultUser(UserId $uid = null)
    {

        if (!$uid instanceof UserId) {
            $uid = UserId::getNext();
        }

        return new User(
            $uid,
            new UserName(self::USER_NAME),
            new UserEmail(self::USER_EMAIL),
            new UserPassword(self::USER_PASSWORD, new MockPasswordEncodingStrategy())
        );
    }

    /**
     * @return CreateUserRequest
     */
    protected function getCreateUserRequest()
    {
        $createUserRequest = new CreateUserRequest(
            self::USER_NAME,
            self::USER_EMAIL,
            self::USER_PASSWORD,
            new MockPasswordEncodingStrategy()
        );
        return $createUserRequest;
    }

    /**
     * @param string $userId
     * @return UpdateUserRequest
     */
    protected function getUpdateUserRequest($userId = '')
    {
        $updateUserRequest = new UpdateUserRequest(
            $userId == '' ? self::USER_ID : $userId,
            self::SECOND_USER_NAME,
            self::SECOND_USER_EMAIL,
            self::SECOND_USER_PASSWORD,
            new MockPasswordEncodingStrategy()
        );
        return $updateUserRequest;
    }

    /**
     * @return CreateUserRequestObject
     */
    protected function getCreateUserRequestObject()
    {
        $requestObject = new CreateUserRequestObject(
            AbstractTestCase::USER_NAME,
            AbstractTestCase::USER_EMAIL,
            AbstractTestCase::USER_PASSWORD,
            new MockPasswordEncodingStrategy()
        );
        return $requestObject;
    }

    /**
     * @param string $userId
     * @return UpdateUserRequestObject
     */
    protected function getUpdateUserRequestObject($userId = '')
    {
        $updateRequestObject = new UpdateUserRequestObject(
            $userId == '' ? self::USER_ID : $userId,
            AbstractTestCase::SECOND_USER_NAME,
            AbstractTestCase::SECOND_USER_EMAIL,
            AbstractTestCase::SECOND_USER_PASSWORD,
            new MockPasswordEncodingStrategy()
        );
        return $updateRequestObject;
    }

}