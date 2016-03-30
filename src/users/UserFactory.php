<?php

namespace naspersclassifieds\olxeu\users;

class UserFactory
{
    public function build(array $data)
    {
        return new User($data['id'], $data['name']);
    }
}