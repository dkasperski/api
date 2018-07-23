<?php

namespace UserBundle\Repository;

use UserBundle\Entity\User;

class DbalUserMapper implements UserMapper
{
    /**
     * @param User $user
     * @return array
     */
    public function toArray(User $user)
    {
        return [
            'id' => $user->getId(),
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'phone' => $user->getPhone()
        ];
    }
}