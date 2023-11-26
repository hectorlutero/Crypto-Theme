<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Services\Contracts;

use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Operations\Contracts\CreateOrUpdateCategoryOperationContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Services\Responses\Contracts\CreateOrUpdateCategoryResponseContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Exceptions\GatewayRequestException;

/**
 * Contract for categories services.
 */
interface CategoriesServiceContract
{
    /**
     * Creates or updates a category.
     *
     * @param CreateOrUpdateCategoryOperationContract $operation
     * @return CreateOrUpdateCategoryResponseContract
     * @throws GatewayRequestException
     */
    public function createOrUpdateCategory(CreateOrUpdateCategoryOperationContract $operation) : CreateOrUpdateCategoryResponseContract;

    /**
     * Creates a category.
     *
     * @param CreateOrUpdateCategoryOperationContract $operation
     * @return CreateOrUpdateCategoryResponseContract
     * @throws GatewayRequestException
     */
    public function createCategory(CreateOrUpdateCategoryOperationContract $operation) : CreateOrUpdateCategoryResponseContract;

    /**
     * Updates a category.
     *
     * @param CreateOrUpdateCategoryOperationContract $operation
     * @param string $remoteId
     * @return CreateOrUpdateCategoryResponseContract
     * @throws GatewayRequestException
     */
    public function updateCategory(CreateOrUpdateCategoryOperationContract $operation, string $remoteId) : CreateOrUpdateCategoryResponseContract;
}
