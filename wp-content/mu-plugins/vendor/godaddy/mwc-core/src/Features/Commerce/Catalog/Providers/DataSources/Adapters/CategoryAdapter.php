<?php

namespace GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Providers\DataSources\Adapters;

use GoDaddy\WordPress\MWC\Common\DataSources\Contracts\DataSourceAdapterContract;
use GoDaddy\WordPress\MWC\Common\Exceptions\AdapterException;
use GoDaddy\WordPress\MWC\Common\Helpers\ArrayHelper;
use GoDaddy\WordPress\MWC\Common\Helpers\TypeHelper;
use GoDaddy\WordPress\MWC\Common\Models\Taxonomy;
use GoDaddy\WordPress\MWC\Common\Models\Term;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Providers\DataObjects\Categories\Category;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Providers\GoDaddy\Adapters\Traits\CanConvertDateTimeFromTimestampTrait;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Providers\GoDaddy\Adapters\Traits\CanParseNullableStringPropertyTrait;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Catalog\Services\Contracts\CategoriesMappingServiceContract;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Exceptions\MissingCategoryRemoteIdException;
use GoDaddy\WordPress\MWC\Core\Features\Commerce\Exceptions\MissingCategoryRemoteIdForParentException;

/**
 * Adapter to convert data into {@see Category} objects.
 */
class CategoryAdapter implements DataSourceAdapterContract
{
    use CanParseNullableStringPropertyTrait;
    use CanConvertDateTimeFromTimestampTrait;

    protected CategoriesMappingServiceContract $categoriesMappingService;

    /**
     * Constructor.
     *
     * @param CategoriesMappingServiceContract $categoriesMappingService
     */
    public function __construct(CategoriesMappingServiceContract $categoriesMappingService)
    {
        $this->categoriesMappingService = $categoriesMappingService;
    }

    /**
     * Converts a {@see Term} model into a {@see Category} object.
     *
     * @param Term|null $term
     * @return Category
     * @throws AdapterException|MissingCategoryRemoteIdForParentException
     */
    public function convertToSource(Term $term = null) : Category
    {
        if (! $term instanceof Term) {
            throw new AdapterException('Missing required Term object.');
        }

        return new Category([
            'altId'       => $term->getName(),
            'description' => $term->getDescription() ?: null,
            'name'        => $term->getLabel(),
            'parentId'    => $term->getParentId() ? $this->convertParentIdToSource($term->getParentId()) : null,
        ]);
    }

    /**
     * Converts a local WooCommerce parent category ID into a Commerce UUID equivalent.
     *
     * @param int $localParentId
     * @return string|null
     * @throws MissingCategoryRemoteIdForParentException
     */
    protected function convertParentIdToSource(int $localParentId) : ?string
    {
        $remoteParentId = $this->categoriesMappingService->getRemoteId($this->getLocalTermModel($localParentId));

        if (! $remoteParentId) {
            // throwing an exception here prevents us from incorrectly identifying the category as having no parent in Commerce
            throw new MissingCategoryRemoteIdForParentException("Failed to retrieve remote ID for parent category {$localParentId}.");
        }

        return $remoteParentId;
    }

    /**
     * Gets a local WooCommerce {@see Term} model from the provided local ID.
     *
     * @param int $localId
     * @return Term
     */
    protected function getLocalTermModel(int $localId) : Term
    {
        $taxonomy = Taxonomy::getNewInstance()->setName('product_cat');

        return Term::getNewInstance($taxonomy)->setId($localId);
    }

    /**
     * {@inheritDoc}
     */
    public function convertFromSource() : void
    {
        // no-op
    }

    /**
     * Converts an array of category data into a {@see Category} object.
     *
     * @param array<string, mixed> $data
     * @return Category
     * @throws MissingCategoryRemoteIdException
     */
    public function convertToSourceFromArray(array $data) : Category
    {
        /** @var array<array<string, string>> $externalIdsData */
        $externalIdsData = TypeHelper::array(ArrayHelper::get($data, 'externalIds'), []);

        return new Category([
            'altId' => $this->parseNullableStringProperty($data, 'altId'),
            // @TODO assets will be converted when we start reading assets from the service {agibson 2023-09-06}
            'categoryId'  => $this->getValidCategoryId($data, 'categoryId'),
            'createdAt'   => $this->convertDateTimeFromTimestamp($data, 'createdAt'),
            'depth'       => TypeHelper::int(ArrayHelper::get($data, 'depth'), 0),
            'description' => $this->parseNullableStringProperty($data, 'description'),
            'externalIds' => ExternalIdsAdapter::getNewInstance()->convertToSourceFromArray($externalIdsData),
            'name'        => TypeHelper::string(ArrayHelper::get($data, 'name'), ''),
            'parentId'    => $this->parseNullableStringProperty($data, 'parentId'),
            'sequence'    => TypeHelper::int(ArrayHelper::get($data, 'sequence'), 1),
            'updatedAt'   => $this->convertDateTimeFromTimestamp($data, 'updatedAt'),
        ]);
    }

    /**
     * Get the valid category ID from the response data.
     *
     * @param array<string, mixed> $data
     * @param string $key
     * @return string|null
     * @throws MissingCategoryRemoteIdException
     */
    protected function getValidCategoryId(array $data, string $key) : ?string
    {
        if ($value = TypeHelper::string(ArrayHelper::get($data, $key), '')) {
            return $value;
        }

        throw new MissingCategoryRemoteIdException('Category ID is missing from response.');
    }
}
