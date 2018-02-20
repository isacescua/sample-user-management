<?php
/**
 * Created by PhpStorm.
 * User: aisacescu
 * Date: 2/16/2018
 * Time: 3:39 PM
 */

namespace TestEndava\Application\Adapter;

use Endava\Application\Adapter\UpdateUserRequestToObjectAdapter;
use Endava\Domain\ValueObject\UpdateUserRequestObject;
use TestEndava\AbstractTestCase;

class UpdateUserRequestToObjectAdapterTest extends AbstractTestCase
{
    public function test__construct()
    {
        $updateUserRequest = $this->getUpdateUserRequest();
        $response          = new UpdateUserRequestToObjectAdapter($updateUserRequest);
        $this->assertInstanceOf(UpdateUserRequestObject::class, $response);
    }
}
