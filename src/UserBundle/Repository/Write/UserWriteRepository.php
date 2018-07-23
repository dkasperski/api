<?php

namespace UserBundle\Repository\Write;

use UserBundle\Entity\User;

interface UserWriteRepository
{
    /**
     * @param User $user
     * @return void
     */
    public function persist(User $user);
}