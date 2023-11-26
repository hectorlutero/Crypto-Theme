<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Inventory\Services;

use GoDaddy\WordPress\MWC\Core\Features\Commerce\Exceptions\CommerceException;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Inventory\Providers\DataObjects\Summary;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Inventory\Providers\GoDaddy\Adapters\Traits\CanConvertSummaryResponseTrait;

/**
 * @method Summary|null get(string $remoteId)
 * @method Summary[] getMany(array $remoteIds)
 * @method Summary remember(string $remoteId, callable $loader)
 * @method set(Summary $resource)
 * @method setMany(Summary[] $resources)
 * @method Summary makeResourceFromArray(array $resourceArray)
 */
class SummariesCachingService extends AbstractCachingService
{
    use CanConvertSummaryResponseTrait {
        convertSummaryResponse as makeResourceFromArray;
    }

    protected string $resourceType = 'inventory-summaries-by-productId';

    /**
     * {@inheritDoc}
     *
     * @param Summary $resource
     */
    protected function getResourceRemoteId(object $resource) : string
    {
        if (! empty($resource->productId)) {
            return $resource->productId;
        }

        throw CommerceException::getNewInstance('The summary has no productId');
    }
}
