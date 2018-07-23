<?php

namespace UserBundle\Factory;

use UserBundle\Entity\User;
use UserBundle\Utils\ArrayVerifyTrait;

class DbalUserFactory implements UserFactory
{
    use ArrayVerifyTrait;

    private $requiredFields = ['id', 'name', 'email', 'phone'];

    /**
     * @param array $data
     * @return User
     */
    public function create(array $data)
    {
        $this->hasRequiredFieldsInArray($this->requiredFields, $data);
        return $this->buildUser($data);
    }

    /**
     * @param array $data
     * @return User
     */
    private function buildUser(array $data)
    {
        $this->validateInput($data);

        return new User(
            $data['name'],
            $data['email'],
            $data['phone'],
            $data['id']
        );
    }

    /**
     * @param array $data
     * @throws \InvalidArgumentException
     */
    private function validateInput(array $data)
    {
        $givenFields = array_keys($data);
        $requiredFields = ['id', 'name', 'email', 'phone'];
        $availableFields = array_intersect($givenFields, $requiredFields);

        if (count($availableFields) < count($requiredFields)) {
            $missingFields = array_diff($requiredFields, $givenFields);
            throw new \InvalidArgumentException(sprintf(
                'Source array does not contain required fields: %s',
                implode(', ', $missingFields)
            ));
        }
    }
}