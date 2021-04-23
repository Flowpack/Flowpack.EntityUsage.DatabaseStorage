<?php
declare(strict_types=1);

namespace Flowpack\EntityUsage\DatabaseStorage\Domain\Model;

/*
 * This file is part of the Flowpack.EntityUsage.DatabaseStorage package.
 *
 * (c) Contributors of the Neos Project - www.neos.io
 *
 * This package is Open Source Software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */

use Doctrine\ORM\Mapping as ORM;
use Flowpack\EntityUsage\EntityUsageInterface;
use Neos\Flow\Annotations as Flow;

/**
 * @Flow\Entity
 * @ORM\Table(
 *     indexes={
 * 	       @ORM\Index(name="entityserviceid",columns={"usageid","entityid","serviceid"}),
 *         @ORM\Index(name="serviceindex",columns={"serviceid"}),
 *         @ORM\Index(name="usageindex",columns={"usageid"}),
 *         @ORM\Index(name="entityindex",columns={"entityid"})
 *     }
 * )
 */
class EntityUsage implements EntityUsageInterface
{

    /**
     * @var string
     */
    protected $usageId;

    /**
     * @var string
     */
    protected $entityId;

    /**
     * @var string
     */
    protected $serviceId;

    /**
     * @var mixed[]
     * @ORM\Column(type="flow_json_array")
     */
    protected $metadata;

    public function __construct(string $usageId, string $entityId, string $serviceId, array $metadata = [])
    {
        $this->usageId = $usageId;
        $this->entityId = $entityId;
        $this->serviceId = $serviceId;
        $this->metadata = $metadata;
    }

    public function getEntityId(): string
    {
        return $this->entityId;
    }

    public function getServiceId(): string
    {
        return $this->serviceId;
    }

    public function getUsageId(): string
    {
        return $this->usageId;
    }

    public function getMetadata(): array
    {
        return $this->metadata;
    }

}
