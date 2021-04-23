<?php
declare(strict_types=1);

namespace Flowpack\EntityUsage\DatabaseStorage\Domain\Model;

use Flowpack\EntityUsage\EntityUsageInterface;
use Flowpack\EntityUsage\EntityUsageQueryResultInterface;
use Neos\Flow\Persistence\QueryResultInterface;

final class EntityUsageQueryResult implements EntityUsageQueryResultInterface
{
    /**
     * @var QueryResultInterface
     */
    private $queryResult;

    public function __construct(QueryResultInterface $queryResult)
    {
        $this->queryResult = $queryResult;
    }

    public function current(): ?EntityUsageInterface
    {
        return $this->queryResult->current();
    }

    public function next(): void
    {
        $this->queryResult->next();
    }

    public function key()
    {
        return $this->queryResult->key();
    }

    public function valid(): bool
    {
        return $this->queryResult->valid();
    }

    public function rewind(): void
    {
        $this->queryResult->rewind();
    }

    public function offsetExists($offset): bool
    {
        return $this->queryResult->offsetExists($offset);
    }

    public function offsetGet($offset): ?EntityUsageInterface
    {
        return $this->queryResult->offsetGet($offset);
    }

    public function offsetSet($offset, $value): void
    {
        throw new \RuntimeException('Unsupported operation: ' . __METHOD__, 1618905013);
    }

    public function offsetUnset($offset): void
    {
        throw new \RuntimeException('Unsupported operation: ' . __METHOD__, 1618905027);
    }

    public function count(): int
    {
        return $this->queryResult->count();
    }

    public function getQuery(): EntityUsageQueryResultInterface
    {
        return $this;
    }

    public function getFirst(): ?EntityUsageInterface
    {
        /** @var EntityUsageInterface $entity */
        $entity = $this->queryResult->getFirst();
        return $entity instanceof EntityUsageInterface ? $entity : null;
    }

    /**
     * @return EntityUsageInterface[]
     */
    public function toArray(): array
    {
        return $this->queryResult->toArray();
    }
}
