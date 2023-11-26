<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\DataSources\WooCommerce\Builders;

use Exception;
use GoDaddy\WordPress\MWC\Common\Exceptions\SentryException;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\DataSources\WooCommerce\Builders\Contracts\ResourceAssociationBuilderContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Models\ResourceMapCollection;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Providers\DataObjects\AbstractDataObject;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Providers\DataObjects\AbstractResourceAssociation;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Services\Contracts\InsertLocalResourceServiceContract;
use GoDaddy\WordPress\MWC\Core\Repositories\AbstractResourceMapRepository;

/**
 * Base class to build associations between remote and local WooCommerce resources.
 */
abstract class AbstractResourceAssociationBuilder implements ResourceAssociationBuilderContract
{
    /** @var AbstractResourceMapRepository resource map repository to look up remote/local IDs */
    protected AbstractResourceMapRepository $resourceMapRepository;

    /** @var InsertLocalResourceServiceContract service to insert resources into the local database */
    protected InsertLocalResourceServiceContract $insertLocalResourceService;

    /** @var string name of the "ID" property on the remote object DTO {@see AbstractDataObject} -- should be the value stored in the resource map table */
    protected string $remoteObjectIdProperty;

    /**
     * Constructor.
     *
     * @param AbstractResourceMapRepository $resourceMapRepository
     * @param InsertLocalResourceServiceContract $insertLocalResourceService
     */
    public function __construct(AbstractResourceMapRepository $resourceMapRepository, InsertLocalResourceServiceContract $insertLocalResourceService)
    {
        $this->resourceMapRepository = $resourceMapRepository;
        $this->insertLocalResourceService = $insertLocalResourceService;
    }

    /**
     * {@inheritDoc}
     */
    public function build(array $resources) : array
    {
        $remoteResourceIds = array_filter(array_column($resources, $this->remoteObjectIdProperty));
        $resourceAssociations = [];

        if (empty($remoteResourceIds)) {
            return $resourceAssociations;
        }

        $localAndRemoteIds = $this->getLocalAndRemoteIds($remoteResourceIds);

        foreach ($resources as $resource) {
            try {
                $localId = $this->getRemoteResourceLocalId($resource, $localAndRemoteIds);
                if (empty($localId)) {
                    // this resource will not be included in the final array
                    continue;
                }

                $resourceAssociations[] = $this->makeResourceAssociation([
                    'localId'        => $localId,
                    'remoteResource' => $resource,
                ]);
            } catch(Exception $exception) {
                // this resource will not be included in the final array
                new SentryException(sprintf('Failed to associate remote resource with local entity: %s', $exception->getMessage()), $exception);
            }
        }

        return $resourceAssociations;
    }

    /**
     * Gets the full mapping database rows (containing both local and remote ID) for the given remote resource IDs.
     *
     * @param string[] $remoteResourceIds
     *
     * @return ResourceMapCollection
     */
    protected function getLocalAndRemoteIds(array $remoteResourceIds) : ResourceMapCollection
    {
        return $this->resourceMapRepository->getMappingsByRemoteIds(array_map('strval', $remoteResourceIds));
    }

    /**
     * Makes a new instance of an {@see AbstractResourceAssociation} object from the provided data.
     *
     * @param array<string, AbstractDataObject|int> $data
     * @return AbstractResourceAssociation
     */
    abstract protected function makeResourceAssociation(array $data) : AbstractResourceAssociation;

    /**
     * Gets the local ID of the provided remote resource. If no local ID exists, a new entry is created.
     *
     * In the event that no local ID is returned, the resource will not be included in the (@see static::build()} results.
     *
     * @param AbstractDataObject $resource
     * @param ResourceMapCollection $resourceMapCollection
     * @return int|null
     */
    protected function getRemoteResourceLocalId(AbstractDataObject $resource, ResourceMapCollection $resourceMapCollection) : ?int
    {
        // find the database row the corresponds to the provided `$resource` object
        if ($localId = $this->getRemoteResourceLocalIdFromMappedIds($resource, $resourceMapCollection)) {
            return $localId;
        }

        if (! $this->shouldInsertLocalResource($resource)) {
            return null;
        }

        // otherwise we have to create a new local resource
        return $this->insertLocalResourceService->insert($resource);
    }

    /**
     * Finds the local ID that corresponds to the provided `$resource` object.
     * If we cannot find a matching result then `null` is returned.
     *
     * @param AbstractDataObject $resource
     * @param ResourceMapCollection $resourceMapCollection
     * @return int|null
     */
    protected function getRemoteResourceLocalIdFromMappedIds(AbstractDataObject $resource, ResourceMapCollection $resourceMapCollection) : ?int
    {
        return $resourceMapCollection->getLocalId($resource->{$this->remoteObjectIdProperty});
    }

    /**
     * Determines whether the provided remote resource should be inserted into the local database.
     * This method is called after we've already determined that there is no local record. This method may be
     * used to perform actions such as: check if the remote resource has been "soft deleted".
     *
     * @param AbstractDataObject $resource
     * @return bool
     */
    protected function shouldInsertLocalResource(AbstractDataObject $resource) : bool
    {
        return true;
    }
}
