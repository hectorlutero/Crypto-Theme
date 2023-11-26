<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\DataStores;

use Exception;
use GoDaddy\WordPress\MWC\Common\DataSources\WordPress\Adapters\TaxonomyTermAdapter;
use GoDaddy\WordPress\MWC\Common\Exceptions\SentryException;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\CatalogIntegration;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Operations\CreateOrUpdateCategoryOperation;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Services\Contracts\CategoriesServiceContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Commerce;
use GoDaddy\WordPress\MWC\Core\Payments\Poynt\Models\Category;
use WP_Term;

/**
 * Commerce Catalog categories data store.
 */
class CategoryDataStore
{
    /** @var CategoriesServiceContract */
    protected CategoriesServiceContract $categoriesService;

    /**
     * Constructor.
     *
     * @param CategoriesServiceContract $categoriesService
     */
    public function __construct(CategoriesServiceContract $categoriesService)
    {
        $this->categoriesService = $categoriesService;
    }

    /**
     * Creates or updates a {@see Category} in the platform for the given local {@see WP_Term} category.
     *
     * @param WP_Term $category
     * @return void
     */
    protected function createOrUpdateCategoryInPlatform(WP_Term $category) : void
    {
        if (! $this->shouldWriteCategoryToPlatform($category)) {
            return;
        }

        try {
            $nativeCategory = TaxonomyTermAdapter::getNewInstance($category)->convertFromSource();
            $operation = CreateOrUpdateCategoryOperation::getNewInstance()->setCategory($nativeCategory);

            $this->categoriesService->createOrUpdateCategory($operation);
        } catch (Exception $e) {
            SentryException::getNewInstance(sprintf('An error occurred trying to create or update a remote record for a category: %s', $e->getMessage()), $e);
        }
    }

    /**
     * Determines whether it should write a {@see WP_Term} category to the platform.
     *
     * @param WP_Term $category
     * @return bool
     */
    protected function shouldWriteCategoryToPlatform(WP_Term $category) : bool
    {
        if (! CatalogIntegration::hasCommerceCapability(Commerce::CAPABILITY_WRITE)) {
            return false;
        }

        // slugs are required & we don't want to write the "Uncategorized" category
        if (empty($category->slug) || $category->slug === 'uncategorized') {
            return false;
        }

        return true;
    }

    /**
     * Creates or updates a local product category as a {@see WP_Term}.
     *
     * @param WP_Term $category
     * @return void
     */
    public function createOrUpdate(WP_Term $category) : void
    {
        $this->createOrUpdateCategoryInPlatform($category);
    }
}
