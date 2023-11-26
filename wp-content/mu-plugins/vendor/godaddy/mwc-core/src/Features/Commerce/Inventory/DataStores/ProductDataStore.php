<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Inventory\DataStores;

use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\DataStores\ProductsDataStore as CatalogProductsDataStore;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Services\Contracts\ProductsServiceContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Inventory\DataStores\Traits\CanCrudPlatformInventoryDataTrait;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Inventory\Providers\Contracts\InventoryProviderContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Inventory\Services\Contracts\LevelsServiceContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Inventory\Services\Contracts\SummariesServiceContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Models\Contracts\CommerceContextContract;

class ProductDataStore extends CatalogProductsDataStore
{
    use CanCrudPlatformInventoryDataTrait;

    /**
     * @param ProductsServiceContract $productsService
     * @param LevelsServiceContract $levelsService
     * @param SummariesServiceContract $summariesCachingService
     * @param InventoryProviderContract $inventoryProvider
     * @param CommerceContextContract $commerceContext
     */
    public function __construct(
        ProductsServiceContract $productsService,
        LevelsServiceContract $levelsService,
        SummariesServiceContract $summariesCachingService,
        InventoryProviderContract $inventoryProvider,
        CommerceContextContract $commerceContext
    ) {
        $this->levelsService = $levelsService;
        $this->summariesService = $summariesCachingService;
        $this->inventoryProvider = $inventoryProvider;
        $this->commerceContext = $commerceContext;

        parent::__construct($productsService);
    }
}
