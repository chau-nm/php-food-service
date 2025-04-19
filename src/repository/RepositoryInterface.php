<?php

namespace app\repository;

interface RepositoryInterface
{
    public function findByKey(string|int $key): mixed;
    public function findAll(): array;
    public function findBy(array $where): array;
    public function save(mixed $entity): mixed;
    public function delete(mixed $entity): int;
    public  function deleteByKey(string $key): int;
}