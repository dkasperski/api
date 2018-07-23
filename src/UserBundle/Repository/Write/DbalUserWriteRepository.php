<?php

namespace UserBundle\Repository\Write;

use UserBundle\Entity\User;
use Doctrine\DBAL\Connection;
use UserBundle\Factory\UserFactory;
use UserBundle\Repository\UserMapper;

class DbalUserWriteRepository implements UserWriteRepository
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
     * @var UserMapper
     */
    private $mapper;

    /**
     * @var string
     */
    protected $tableName = '`users`';

    /**
     * @param Connection $connection
     * @param UserFactory $userFactory
     * @param UserMapper $mapper
     */
    public function __construct(Connection $connection, UserFactory $userFactory, UserMapper $mapper)
    {
        $this->connection = $connection;
        $this->userFactory = $userFactory;
        $this->mapper = $mapper;
    }

    /**
     * @param User $user
     * @return void
     */
    public function persist(User $user)
    {
        if ($this->whetherUserExistInDb($user)) {
            $this->executeUpdateQuery($user);
        } else {
            $this->executeInsertQuery($user);
        }
    }

    /**
     * @param User $user
     * @return bool
     */
    private function whetherUserExistInDb(User $user)
    {
        $userEmail = $user->getEmail();

        $query = $this->connection->createQueryBuilder();
        $stm = $query->select('1')
            ->from($this->tableName)
            ->where('email = ' . $query->createNamedParameter($userEmail))
            ->setMaxResults(1)
            ->execute();

        return $stm->fetch(\PDO::FETCH_COLUMN) !== false;
    }

    /**
     * @param User $user
     */
    private function executeUpdateQuery(User $user)
    {
        $userEmail = $user->getEmail();

        $query = $this->connection->createQueryBuilder();
        $query->update($this->tableName)
            ->where('email = ' . $query->createNamedParameter($userEmail));

        $data = $this->mapToArray($user);
        foreach ($data as $field => $value) {
            $query->set($field, $query->createNamedParameter($value));
        }

        $query->execute();
    }

    /**
     * @param User $user
     */
    private function executeInsertQuery(User $user)
    {
        $query = $this->connection->createQueryBuilder()
            ->insert($this->tableName);

        $data = $this->mapToArray($user);
        foreach ($data as $field => $value) {
            $query->setValue($field, $query->createPositionalParameter($value));
        }

        $query->execute();
    }

    /**
     * @param User $user
     * @return array
     */
    private function mapToArray(User $user)
    {
        return $this->mapper->toArray($user);
    }
}