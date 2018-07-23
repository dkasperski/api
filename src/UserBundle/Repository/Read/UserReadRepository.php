<?php

namespace UserBundle\Repository\Read;

use UserBundle\Entity\User;

interface UserReadRepository
{
    /**
     * @param int $userId
     * @return User|null
     */
    public function getUser($userId);

    /**
     * @return User[]
     */
    public function getAllUsers();
}