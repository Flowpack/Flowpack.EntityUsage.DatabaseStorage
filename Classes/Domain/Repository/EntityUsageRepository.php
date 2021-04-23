<?php
declare(strict_types=1);

namespace Flowpack\EntityUsage\DatabaseStorage\Domain\Repository;

/*
 * This file is part of the Flowpack.EntityUsage.DatabaseStorage package.
 *
 * (c) Contributors of the Neos Project - www.neos.io
 *
 * This package is Open Source Software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */

use Flowpack\EntityUsage\DatabaseStorage\Domain\Model\EntityUsage;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Persistence\QueryResultInterface;
use Neos\Flow\Persistence\Repository;

/**
 * @Flow\Scope("singleton")
 *
 * @method QueryResultInterface findByEntityId(string $entityId)
 * @method QueryResultInterface findByServiceId(string $serviceId)
 * @method EntityUsage findOneByUsageId(string $serviceId)
 * @method int countByUsageId(string $usageId)
 * @method int countByEntityId(string $entityId)
 * @method int countByServiceId(string $serviceId)
 */
class EntityUsageRepository extends Repository
{

    public function findByEntityAndService(string $entityId, string $serviceId): QueryResultInterface
    {
        $query = $this->createQuery();
        return $query
            ->matching(
                $query->logicalAnd([
                    $query->equals('entityId', $entityId),
                    $query->equals('serviceId', $serviceId),
                ])
            )
            ->execute();
    }

    public function findByUsageAndEntity(string $usageId, string $entityId): QueryResultInterface
    {
        $query = $this->createQuery();
        return $query
            ->matching(
                $query->logicalAnd([
                    $query->equals('usageId', $usageId),
                    $query->equals('entityId', $entityId),
                ])
            )
            ->execute();
    }

    public function findOneByUsageAndEntityAndService(
        string $usageId,
        string $entityId,
        string $serviceId
    ): ?EntityUsage {
        $query = $this->createQuery();
        /** @var EntityUsage $result */
        $result = $query
            ->matching(
                $query->logicalAnd([
                    $query->equals('usageId', $usageId),
                    $query->equals('entityId', $entityId),
                    $query->equals('serviceId', $serviceId)
                ])
            )
            ->execute()
            ->getFirst();
        return $result;
    }

}
