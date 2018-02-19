<?php
/**
 * Created by PhpStorm.
 * User: aisacescu
 * Date: 2/16/2018
 * Time: 3:39 PM
 */

namespace TestEndava\Application\Adapter;

use Endava\Application\Adapter\UpdateUserRequestToObjectAdapter;
use Endava\Application\Request\UpdateUserRequest;
use Endava\Domain\ValueObject\UpdateUserRequestObject;
use PHPUnit\Framework\TestCase;
use TestEndava\Infrastructure\PasswordEncodingStrategies\MockPasswordEncodingStrategy;

class UpdateUserRequestToObjectAdapterTest extends TestCase
{

    const USER_ID = 'SAMPLE';
    const USER_NAME = 'Andrei';
    const USER_EMAIL = 'andrei.isacescu@endava.com';
    const USER_PASSWORD = 'myPassword';

    public function test__construct()
    {

        $updateUserRequest = new UpdateUserRequest(
            self::USER_ID,
            self::USER_NAME,
            self::USER_EMAIL,
            self::USER_PASSWORD,
            new MockPasswordEncodingStrategy()
        );

        $response = new UpdateUserRequestToObjectAdapter($updateUserRequest);

        $this->assertInstanceOf(UpdateUserRequestObject::class, $response);
    }
}
