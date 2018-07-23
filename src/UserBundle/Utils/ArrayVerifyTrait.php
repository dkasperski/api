<?php

namespace UserBundle\Utils;

trait ArrayVerifyTrait
{
    /**
     * @param array $value
     * @return void
     * @throws \InvalidArgumentException
     */
    protected function validateArrayType($value)
    {
        if (!is_array($value)) {
            throw new \InvalidArgumentException(sprintf("Given value must be type of array. %s given", gettype($value)));
        }
    }

    /**
     * @param array $fields
     * @param array $value
     * @return void
     * @throws \InvalidArgumentException
     */
    protected function hasRequiredFieldsInArray(array $fields, array $value)
    {
        $diff = array_diff($fields, array_keys($value));
        if (count($diff) !== 0) {
            throw new \InvalidArgumentException(sprintf('Required fields "%s" not found in array', implode(', ', $diff)));
        }
    }

    /**
     * @param array $fields
     * @param $type
     */
    protected function hasRequiredTypesInArray(array $fields, $type)
    {
        $result = array_filter($fields, function ($field) use ($type) {
            return $field instanceof $type;
        });

        if (count($result) !== count($fields)) {
            throw new \InvalidArgumentException(sprintf(
                'Array has at least one element which is not an instance of "%s"', $type
            ));
        }
    }

    /**
     * @param array $fields
     * @param $value
     */
    protected function hasValueInArray(array $fields, $value)
    {
        if (in_array($value, $fields) === false) {
            throw new \InvalidArgumentException(sprintf(
                '"%s" is not correct value in array', $value
            ));
        }
    }
}