<?php

require_once("../vendor/autoload.php");

use \Endava\Application\Controller\UserController as UserController;
use \Endava\Domain\Service\UserService as UserService;
use \Endava\Infrastructure\Persistence\InMemory\InMemoryUserRepository as InMemoryUserRepository;
use \Endava\Infrastructure\Factory\UserFactory as UserFactory;
use \Endava\Infrastructure\PasswordEncodingStrategies\Md5PasswordEncodingStrategy as Md5PasswordEncodingStrategy;

const SAMPLE_USERNAME      = 'DummyUsername';
const SAMPLE_EMAIL_ADDRESS = 'DummyEmailAddress@email.com';
const SAMPLE_PASSWORD      = 'Password';

// Uncomment this if you are working with REDIS
// $clientRedis = new Predis\Client(['scheme' => 'tcp', 'host' => 'localhost', 'port' => 6379]);

$userController    = new UserController(new UserService(new InMemoryUserRepository(), new UserFactory()));
$createUserRequest = new \Endava\Application\Request\CreateUserRequest(SAMPLE_USERNAME, SAMPLE_EMAIL_ADDRESS, SAMPLE_PASSWORD, new Md5PasswordEncodingStrategy());

try {
    $userId          = $userController->postUser($createUserRequest);
    $userInformation = $userController->getUser($userId);
} catch (\Exception $exception) {
    echo $exception->getMessage();
    exit;
}

echo "User ID : <b>".$userInformation->getUserId()."</b> created with email <b>".$userInformation->getUserEmail()->getUserEmail()."</b>.";