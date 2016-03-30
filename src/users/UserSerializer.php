<?php

namespace naspersclassifieds\olxeu\users;

class UserSerializer implements \JsonSerializable
{
    /** @var User */
    private $user;

    /**
     * UserSerializer constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    function jsonSerialize()
    {
        return [
            'id' => $this->user->getId(),
            'name' => $this->user->getName(),
        ];
    }
}