<?php
/**
 * Created by PhpStorm.
 * User: aisacescu
 * Date: 2/16/2018
 * Time: 10:26 AM
 */

namespace Endava\Domain\Service;


use Endava\Domain\Model\UserFactoryInterface;
use Endava\Domain\Model\UserRepositoryInterface;
use Endava\Domain\ValueObject\CreateUserRequestObject;
use Endava\Domain\ValueObject\UpdateUserRequestObject;
use Endava\Domain\ValueObject\UserId;

/**
 *
 * Operates only on types belonging to the domain.
 * It contains meaningful concepts that can be found within the domains
 * ubiquitous language.
 *
 * Class UserService
 * @package Endava\Domain\Service
 */
class UserService implements UserServiceInterface
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;
    /**
     * @var UserFactoryInterface
     */
    private $userFactory;

    /**
     * UserService constructor.
     * @param UserRepositoryInterface $userRepository
     * @param UserFactoryInterface $userFactory
     */
    public function __construct(UserRepositoryInterface $userRepository, UserFactoryInterface $userFactory)
    {
        $this->userRepository = $userRepository;
        $this->userFactory    = $userFactory;
    }

    /**
     * @param CreateUserRequestObject $requestObject
     * @return \Endava\Domain\Model\User
     */
    public function register(CreateUserRequestObject $requestObject)
    {
        $newUser = $this->userFactory->createFromCreateRequest($requestObject);
        $this->userRepository->add($newUser);
        return $newUser;
    }

    /**
     * @param UpdateUserRequestObject $requestObject
     */
    public function update(UpdateUserRequestObject $requestObject)
    {

        $user = $this->userFactory->createFromUpdateRequest($requestObject);
        $this->userRepository->update($user);
    }

    /**
     * @param string $userId
     */
    public function delete($userId)
    {
        $user = $this->userRepository->userOfId(UserId::fromString($userId));
        $this->userRepository->remove($user);
    }

    /**
     * @param string $userId
     * @return \Endava\Domain\Model\User
     */
    public function getUserFromId($userId)
    {
        return $this->userRepository->userOfId(UserId::fromString($userId));
    }

}