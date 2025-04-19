<?php

namespace app\repository;

/**
 * @copyright chau-nm
 */
interface RepositoryInterface
{
    /**
     * Find entity from primary key
     *
     * @param string|int $key
     * @return mixed
     */
    public function findByKey(string|int $key): mixed;

    /**
     * Get all data
     *
     * @return array
     */
    public function findAll(): array;

    /**
     * Find data with where condition
     *
     * @param array $where
     * @return array
     */
    public function findBy(array $where): array;

    /**
     * Save data. If data existed then update data
     *
     * @param mixed $entity
     * @return mixed
     */
    public function save(mixed $entity): mixed;

    /**
     * Delete data by primary key
     *
     * @param string $key
     * @return int
     */
    public  function deleteByKey(string $key): int;
}