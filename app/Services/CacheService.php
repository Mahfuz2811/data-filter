<?php

namespace App\Services;

use Illuminate\Contracts\Cache\Repository;

class CacheService
{
    private static $KEY_USER_INFO = 'user-info-%s-%s';

    private $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function keyResolver(string $specifier, ...$values): string
    {
        return sprintf($specifier, ...$values);
    }

    public function getUserInfoKey($year = null, string $month = null): string
    {
        return $this->keyResolver(self::$KEY_USER_INFO, $year, $month);
    }

    public function setUserInfoData($data, string $year = null, string $month = null, $ttl = null): void
    {
        $key = $this->keyResolver(self::$KEY_USER_INFO, $year, $month);
        $this->repository->set($key, $data, $ttl);
    }

    public function getUserInfoData(string $year = null, string $month = null)
    {
        $key = $this->keyResolver(self::$KEY_USER_INFO, $year, $month);
        return $this->repository->get($key);
    }
}
