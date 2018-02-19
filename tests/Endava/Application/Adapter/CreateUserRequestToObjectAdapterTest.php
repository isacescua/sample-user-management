<?php
/**
 * Created by PhpStorm.
 * User: aisacescu
 * Date: 2/16/2018
 * Time: 3:30 PM
 */

namespace TestEndava\Application\Adapter;

use Endava\Application\Adapter\CreateUserRequestToObjectAdapter;
use Endava\Application\Request\CreateUserRequest;
use Endava\Domain\ValueObject\CreateUserRequestObject;
use PHPUnit\Framework\TestCase;
use TestEndava\Infrastructure\PasswordEncodingStrategies\MockPasswordEncodingStrategy;

class CreateUserRequestToObjectAdapterTest extends TestCase
{
    public function test_constructor(){

        $createUserRequest = new CreateUserRequest(
            'userName',
            'userEmail@email.com',
            'userPassword',
            new MockPasswordEncodingStrategy()
        );

        $response = new CreateUserRequestToObjectAdapter($createUserRequest);

        $this->assertInstanceOf(CreateUserRequestObject::class, $response);
    }
}
