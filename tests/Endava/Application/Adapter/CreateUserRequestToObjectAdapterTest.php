<?php
/**
 * Created by PhpStorm.
 * User: aisacescu
 * Date: 2/16/2018
 * Time: 3:30 PM
 */

namespace TestEndava\Application\Adapter;

use Endava\Application\Adapter\CreateUserRequestToObjectAdapter;
use Endava\Domain\ValueObject\CreateUserRequestObject;
use TestEndava\AbstractTestCase;

class CreateUserRequestToObjectAdapterTest extends AbstractTestCase
{
    public function test_constructor()
    {
        $createUserRequest = $this->getCreateUserRequest();
        $response          = new CreateUserRequestToObjectAdapter($createUserRequest);
        $this->assertInstanceOf(CreateUserRequestObject::class, $response);
    }
}
