<?php

namespace UserBundle\Repository;

use UserBundle\Entity\User;

interface UserMapper
{
    /**
     * @param User $user
     * @return array
     */
    public function toArray(User $user);
}
