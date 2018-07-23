<?php

namespace UserBundle\Factory;

use UserBundle\Entity\User;

interface UserFactory
{
    /**
     * @param array $data
     * @return User
     */
    public function create(array $data);
}