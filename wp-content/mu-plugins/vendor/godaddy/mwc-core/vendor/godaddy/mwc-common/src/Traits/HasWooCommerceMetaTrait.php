<?php

namespace GoDaddy\WordPress\MWC\Common\Traits;

use WC_Data;

/**
 * A trait used for handling WooCommerce metadata.
 *
 * @deprecated use {@see HasWooCommerceObjectMetaTrait} or {@see HasPostMetaTrait} instead.
 */
trait HasWooCommerceMetaTrait
{
    /** @var WC_Data|int data object instance or ID of the object that owns the metadata */
    protected $objectOrObjectId;

    /** @var string meta key used to store the metadata */
    protected $metaKey;

    /** @var string|array<mixed>|int|float|bool|null value to be stored as meta data */
    protected $metaValue;

    /**
     * Loads and returns the value stored in the metadata.
     *
     * @param string|array<mixed>|int|float|bool|null $defaultValue optional, defaults to
     * @return string|array<mixed>|int|float|bool|null
     */
    protected function loadWooCommerceMeta($defaultValue = null)
    {
        $this->metaValue = $defaultValue;

        if (is_int($this->objectOrObjectId) && metadata_exists('post', $this->objectOrObjectId, $this->metaKey)) {
            $this->metaValue = get_post_meta($this->objectOrObjectId, $this->metaKey, true);
        } elseif (is_object($this->objectOrObjectId) && is_callable([$this->objectOrObjectId, 'meta_exists']) && is_callable([$this->objectOrObjectId, 'get_meta']) && $this->objectOrObjectId->meta_exists($this->metaKey)) {
            $this->metaValue = $this->objectOrObjectId->get_meta($this->metaKey, true);
        }

        return $this->metaValue;
    }

    /**
     * Gets the meta data value.
     *
     * @return string|array<mixed>|int|float|bool|null
     */
    protected function getWooCommerceMeta()
    {
        return $this->metaValue;
    }

    /**
     * Sets the metadata value.
     *
     * @param string|array<mixed>|int|float|bool|null $value metadata value
     * @return self
     */
    protected function setWooCommerceMeta($value = null) : self
    {
        $this->metaValue = $value;

        return $this;
    }

    /**
     * Saves the WooCommerce metadata.
     *
     * @return self
     */
    protected function saveWooCommerceMeta() : self
    {
        if (is_int($this->objectOrObjectId)) {
            update_post_meta($this->objectOrObjectId, $this->metaKey, $this->metaValue);
        } elseif (is_object($this->objectOrObjectId) && is_callable([$this->objectOrObjectId, 'update_meta_data']) && is_callable([$this->objectOrObjectId, 'save_meta_data'])) {
            $this->objectOrObjectId->update_meta_data($this->metaKey, $this->metaValue);
            $this->objectOrObjectId->save_meta_data();
        }

        return $this;
    }

    /**
     * Deletes the WooCommerce metadata.
     *
     * @return self
     */
    protected function deleteWooCommerceMeta() : self
    {
        if (is_int($this->objectOrObjectId)) {
            delete_post_meta($this->objectOrObjectId, $this->metaKey);
        } elseif (is_object($this->objectOrObjectId) && is_callable([$this->objectOrObjectId, 'delete_meta_data']) && is_callable([$this->objectOrObjectId, 'save_meta_data'])) {
            $this->objectOrObjectId->delete_meta_data($this->metaKey);
            $this->objectOrObjectId->save_meta_data();
        }

        return $this;
    }
}
