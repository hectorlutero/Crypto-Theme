<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Interceptors\Handlers;

use Exception;
use GoDaddy\WordPress\MWC\Common\Exceptions\SentryException;
use GoDaddy\WordPress\MWC\Common\Helpers\TypeHelper;
use GoDaddy\WordPress\MWC\Common\Repositories\WooCommerce\ProductsRepository;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\CatalogIntegration;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Operations\CreateOrUpdateProductOperation;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Operations\ListProductsOperation;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Services\Contracts\ProductsServiceContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Exceptions\MissingRemoteIdsAfterLocalIdConversionException;
use GoDaddy\WordPress\MWC\Core\Interceptors\Handlers\AbstractInterceptorHandler;
use GoDaddy\WordPress\MWC\Core\WooCommerce\Adapters\ProductAdapter;
use WC_Product;
use WC_Product_External;
use WC_Product_Grouped;
use WC_Product_Variable;
use WC_Product_Variation;

/**
 * Handles creating or updating variants in the remote platform.
 */
class CreateOrUpdateRemoteVariantsJobHandler extends AbstractInterceptorHandler
{
    protected ProductsServiceContract $productsService;

    public function __construct(ProductsServiceContract $productsService)
    {
        $this->productsService = $productsService;
    }

    /**
     * Identifies which local variants don't yet exist in the remote platform and creates them.
     *
     * @param ...$args
     * @return void
     */
    public function run(...$args)
    {
        if (! isset($args[0])) {
            return;
        }

        $variantIds = TypeHelper::arrayOfIntegers($args[0]);

        // find the variants already in the platform,
        // we don't need to create them.
        $existingVariantIds = $this->listExistingVariants($variantIds);

        $variantIdsToCreate = array_values(array_diff($variantIds, $existingVariantIds));

        $this->createOrUpdateVariants($variantIdsToCreate);
    }

    /**
     * Determines which of the supplied local product IDs exist in the remote platform.
     *
     * @param int[] $localVariantIds Array of local product IDs to check in the platform.
     * @return int[] Array of local product IDs that were found in the remote platform.
     */
    protected function listExistingVariants(array $localVariantIds) : array
    {
        try {
            $response = $this->productsService->listProducts(
                ListProductsOperation::getNewInstance()
                    ->setLocalIds($localVariantIds)
                    ->setPageSize(count($localVariantIds))
            );

            return array_column($response->getProducts(), 'localId');
        } catch(MissingRemoteIdsAfterLocalIdConversionException $e) {
            // we are not expecting to find variants in most cases, no need to do anything with this exception
        } catch (Exception $e) {
            SentryException::getNewInstance('Failed to list existing variants', $e);
        }

        return [];
    }

    /**
     * Creates the supplied local product variants in the remote platform.
     *
     * @param int[] $localVariantIds
     * @return void
     */
    protected function createOrUpdateVariants(array $localVariantIds) : void
    {
        foreach ($localVariantIds as $localVariantId) {
            /** @var WC_Product|WC_Product_External|WC_Product_Grouped|WC_Product_Variable|WC_Product_Variation|null $variantProduct */
            $variantProduct = CatalogIntegration::withoutReads(function () use ($localVariantId) {
                return ProductsRepository::get($localVariantId);
            });

            if ($variantProduct) {
                $this->createOrUpdateRemoteProduct($variantProduct);
            }
        }
    }

    /**
     * Create or update the remote product corresponding to the local WC_Product.
     *
     * @param WC_Product $wcProduct
     * @return void
     */
    protected function createOrUpdateRemoteProduct(WC_Product $wcProduct) : void
    {
        try {
            $product = ProductAdapter::getNewInstance($wcProduct)->convertFromSource();
            $operation = CreateOrUpdateProductOperation::fromProduct($product);
            $this->productsService->createOrUpdateProduct($operation);
        } catch (Exception $e) {
            SentryException::getNewInstance('Could not create variant products.', $e);
        }
    }
}
