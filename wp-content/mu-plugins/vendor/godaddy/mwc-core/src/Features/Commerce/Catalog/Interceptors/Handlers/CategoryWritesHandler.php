<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Interceptors\Handlers;

use GoDaddy\WordPress\MWC\Common\Helpers\ArrayHelper;
use GoDaddy\WordPress\MWC\Common\Helpers\TypeHelper;
use GoDaddy\WordPress\MWC\Common\Repositories\WordPress\TermsRepository;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\CatalogIntegration;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\DataStores\CategoryDataStore;
use GoDaddy\WordPress\MWC\Core\Interceptors\Handlers\AbstractInterceptorHandler;
use WP_Term;

/**
 * Handler for the {@see CategoryWritesInterceptor}.
 */
class CategoryWritesHandler extends AbstractInterceptorHandler
{
    protected CategoryDataStore $categoryDataStore;

    public function __construct(CategoryDataStore $categoryDataStore)
    {
        $this->categoryDataStore = $categoryDataStore;
    }

    /**
     * Creates or updates a product category in the service after one is saved locally.
     *
     * @param ...$args
     * @return void
     */
    public function run(...$args)
    {
        $termId = TypeHelper::int(ArrayHelper::get($args, 0), 0);

        if (! $wpTerm = $this->getWordPressTermObject($termId)) {
            return;
        }

        $this->categoryDataStore->createOrUpdate($wpTerm);
    }

    /**
     * Gets the WordPress {@see WP_Term} object for the supplied term ID.
     * We disable reads during this operation, as we want the data from the local database only.
     *
     * @param int $termId
     * @return WP_Term|null
     */
    protected function getWordPressTermObject(int $termId) : ?WP_Term
    {
        if (! $termId) {
            return null;
        }

        /** @var WP_Term|null $wpTerm */
        $wpTerm = CatalogIntegration::withoutReads(fn () => TermsRepository::getTerm($termId));

        return $wpTerm;
    }
}
