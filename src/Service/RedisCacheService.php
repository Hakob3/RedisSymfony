<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Psr\Cache\InvalidArgumentException;
use Symfony\Component\Cache\Adapter\RedisAdapter;
use Symfony\Component\Serializer\SerializerInterface;

readonly class RedisCacheService
{
    private RedisAdapter $cache;

    public function __construct(
        string $redisUrl,
        private EntityManagerInterface $entityManager,
        private SerializerInterface $serializer,
    ) {
        $client = RedisAdapter::createConnection($redisUrl);
        $this->cache = new RedisAdapter($client);
    }

    /**
     * @param int $id
     * @param string $entityClass
     * @return mixed|string
     * @throws InvalidArgumentException
     */
    public function getCachedResults(int $id, string $entityClass): mixed
    {
        $cacheKey = sprintf('%s_get_%s', ClassHelper::getEntityShortName($entityClass), $id);

        $cacheItem = $this->cache->getItem($cacheKey);
        if ($cacheItem->isHit()) {
            return $cacheItem->get();
        }

        $entity = $this->entityManager->getRepository($entityClass)->find($id);
        $result = $this->serializer->serialize($entity, 'json');

        $cacheItem->set($result);
        $cacheItem->expiresAfter(60);
        $this->cache->save($cacheItem);

        return $result;
    }
}
