<?php

namespace naspersclassifieds\olxeu\users;

class UserRepository
{
    /** @var UserFactory */
    private $factory;

    /**
     * UserRepository constructor.
     * @param UserFactory $factory
     */
    public function __construct(UserFactory $factory = null)
    {
        $this->factory = $factory ?: new UserFactory();
    }


    public function findById($id = 'me')
    {
        return $this->factory->build([
            'id' => 1,
            'name' => 'ME',
        ]);
    }
}