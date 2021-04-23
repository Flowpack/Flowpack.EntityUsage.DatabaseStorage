<?php
declare(strict_types=1);

namespace Flowpack\EntityUsage\DatabaseStorage;

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
use Flowpack\EntityUsage\DatabaseStorage\Domain\Model\EntityUsageQueryResult;
use Flowpack\EntityUsage\DatabaseStorage\Domain\Repository\EntityUsageRepository;
use Flowpack\EntityUsage\EntityUsageQueryResultInterface;
use Flowpack\EntityUsage\EntityUsageStorageInterface;
use Neos\Flow\Annotations as Flow;

class EntityUsageStorage implements EntityUsageStorageInterface
{

    /**
     * @Flow\Inject
     * @var EntityUsageRepository
     */
    protected $entityUsageRepository;

    public function isInUse(string $entityId): bool
    {
        return $this->entityUsageRepository->countByEntityId($entityId) > 0;
    }

    public function getUsages(string $entityId): EntityUsageQueryResultInterface
    {
        return new EntityUsageQueryResult($this->entityUsageRepository->findByEntityId($entityId));
    }

    public function getUsagesForService(string $serviceId): EntityUsageQueryResultInterface
    {
        return new EntityUsageQueryResult($this->entityUsageRepository->findByServiceId($serviceId));
    }

    public function registerUsage(string $usageId, string $entityId, string $serviceId, array $metadata = []): void
    {
        if ($this->entityUsageRepository->findOneByUsageAndEntityAndService($usageId, $entityId, $serviceId)) {
            return;
        }
        $usage = new EntityUsage($usageId, $entityId, $serviceId, $metadata);
        $this->entityUsageRepository->add($usage);
    }

    public function unregisterUsage(string $usageId, string $entityId, string $serviceId): void
    {
        $usage = $this->entityUsageRepository->findOneByUsageAndEntityAndService($usageId, $entityId, $serviceId);
        if ($usage) {
            $this->entityUsageRepository->remove($usage);
        }
    }

    public function unregisterUsagesByEntity(string $entityId): void
    {
        $usages = $this->entityUsageRepository->findByEntityId($entityId);
        foreach ($usages as $usage) {
            $this->entityUsageRepository->remove($usage);
        }
    }

    public function unregisterUsagesByService(string $serviceId): void
    {
        $usages = $this->entityUsageRepository->findByServiceId($serviceId);
        foreach ($usages as $usage) {
            $this->entityUsageRepository->remove($usage);
        }
    }
}
