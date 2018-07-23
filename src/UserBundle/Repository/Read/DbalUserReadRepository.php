<?php

namespace UserBundle\Repository\Read;

use UserBundle\Entity\User;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\DBAL\Connection;
use UserBundle\Factory\UserFactory;

class DbalUserReadRepository implements UserReadRepository
{
    /**
     * @var Connection
     */
    private $connection;

    /**
     * @var UserFactory
     */
    private $userFactory;

    /**
     * @var string
     */
    protected $tableName = '`users`';

    /**
     * @param Connection $connection
     * @param UserFactory $userFactory
     */
    public function __construct(Connection $connection, UserFactory $userFactory)
    {
        $this->connection = $connection;
        $this->userFactory = $userFactory;
    }

    /**
     * @param int $userId
     * @return User
     */
    public function getUser($userId)
    {
        $data = $this->executeSelectByUserIdQuery($userId);

        if ($data === false) {
            return null;
        }

        return $this->userFactory->create($data);
    }

    /**
     * @return User[]
     */
    public function getAllUsers()
    {
        $data = $this->executeSelectAllQuery();

        $result = [];
        foreach ($data as $row) {
            $result[] = $this->userFactory->create($row);
        }

        return $result;
    }

    /**
     * @param $userId
     * @return array
     */
    private function executeSelectByUserIdQuery($userId)
    {
        $query = $this->createSelectQuery();
        $stm = $query->where('id = ' . $query->createNamedParameter($userId))
            ->setMaxResults(1)
            ->execute();

        return $stm->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * @return array
     */
    private function executeSelectAllQuery()
    {
        $stm = $this->createSelectQuery()->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @return QueryBuilder
     */
    private function createSelectQuery()
    {
        return $this->connection->createQueryBuilder()
            ->select('id', 'name', 'email', 'phone')
            ->from($this->tableName);
    }
}