<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce;

use GoDaddy\WordPress\MWC\Common\Database\AbstractDatabaseTableAction;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Enums\CommerceTables;
use GoDaddy\WordPress\MWC\Core\Repositories\AbstractResourceMapRepository;

/**
 * This table will store the last time a resource type was updated.
 *
 * This is helpful to compare the updatedAt value of a remote object with the value stored in this table.
 * If the remote object has a more recent updatedAt value, then we know we might need to purge the local cache for that resource.
 * When doing that, we should also update the value in this table.
 *
 * @see AbstractResourceMapRepository::getResourceUpdatedAt()
 * @see AbstractResourceMapRepository::updateResourceUpdatedAt()
 */
class CreateCommerceResourceUpdatesTableAction extends AbstractDatabaseTableAction
{
    /** {@inheritDoc} */
    public static function getTableName() : string
    {
        return CommerceTables::ResourceUpdates;
    }

    /** {@inheritDoc} */
    protected static function getTableVersion() : int
    {
        return 20230707000600;
    }

    /** {@inheritdoc} */
    protected function createTable() : void
    {
        // @TODO implement this method in MWC-13162 {unfulvio 2023-07-21}
    }
}
