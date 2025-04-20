<?php

namespace app\service;

use app\exception\BadRequestException;
use app\exception\UnauthorizedException;
use app\model\dto\UserDTO;
use app\model\entity\User;
use app\model\request\LoginRequest;
use app\model\request\RegisterRequest;
use app\model\Session;
use app\repository\UserRepository;
use app\util\BcryptEncoder;
use Ramsey\Uuid\Uuid;

class AuthService
{
    private static ?AuthService $instance = null;
    private const LOGIN_KEY = "user_uuid";
    private UserRepository $userRepository;
    private Session $session;

    private function __construct()
    {
        $this->userRepository = UserRepository::getInstance();
        $this->session = Session::getInstance();
    }

    public static function getInstance(): AuthService
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getLoggedInUser(): ?UserDTO
    {
        $userUuid = $this->session->get(self::LOGIN_KEY);
        if (empty($userUuid)) {
            return null;
        }
        $user = $this->userRepository->findByKey($userUuid);
        if (empty($user)) {
            return null;
        }
        return new UserDTO(
            $user->uuid,
            $user->username,
            $user->email,
            $user->firstName,
            $user->lastName,
            $user->phone,
            $user->address,
            $user->avatar
        );
    }

    /**
     * @throws UnauthorizedException
     */
    public function login(LoginRequest $loginRequest): UserDTO
    {
        $username = $loginRequest->username;
        $password = $loginRequest->password;

        $user = $this->userRepository->findByUsername($username);
        if (!$user) {
            throw new UnauthorizedException("User does not exist");
        }

        if (!BcryptEncoder::verify($password, $user->hashPassword)) {
            throw new UnauthorizedException("Password is incorrect");
        }

        $this->session->set(self::LOGIN_KEY, $user->uuid);

        return new UserDTO(
            $user->uuid,
            $user->username,
            $user->email,
            $user->firstName,
            $user->lastName,
            $user->phone,
            $user->address,
            $user->avatar
        );
    }

    /**
     * @throws BadRequestException
     */
    public function register(RegisterRequest $registerRequest): mixed
    {
        $username = $registerRequest->username;

        $user = $this->userRepository->findByUsername($username);
        if ($user) {
            throw new BadRequestException("User is already registered");
        }
        try {
            $registerUser = new User(
                Uuid::uuid4()->toString(),
                $registerRequest->username,
                BcryptEncoder::encode($registerRequest->password),
                $registerRequest->email,
                $registerRequest->firstName,
                $registerRequest->lastName,
                $registerRequest->phone,
                $registerRequest->address,
                null,
                new \DateTimeImmutable('now'),
                null
            );
            return $this->userRepository->save($registerUser);
        } catch (\Exception $e) {
            throw new BadRequestException($e->getMessage());
        }
    }

    public function logout(): void
    {
        $this->session->clear();
    }
}