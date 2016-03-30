<?php


namespace naspersclassifieds\olxeu\users;


use Zend\Diactoros\Response\JsonResponse;

class UserEndpoint
{
    private $userRepository;

    public function __construct(UserRepository $userRepository = null)
    {
        $this->userRepository = $userRepository ?: new UserRepository();
    }

    public function getMe($id)
    {
        $me = $this->userRepository->findById($id);
        return new JsonResponse(new UserSerializer($me));
    }
}