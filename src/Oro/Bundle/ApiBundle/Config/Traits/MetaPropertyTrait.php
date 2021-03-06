<?php

namespace Oro\Bundle\ApiBundle\Config\Traits;

use Oro\Bundle\ApiBundle\Config\EntityDefinitionConfig;

/**
 * Adds the enable/disable meta property related methods to a configuration class.
 *
 * @property array $items
 */
trait MetaPropertyTrait
{
    /**
     * Indicates whether the "disable_meta_properties" option is set explicitly.
     *
     * @return bool
     */
    public function hasDisableMetaProperties()
    {
        return array_key_exists(EntityDefinitionConfig::DISABLE_META_PROPERTIES, $this->items);
    }

    /**
     * Indicates whether a requesting of additional meta properties is enabled.
     *
     * @return bool
     */
    public function isMetaPropertiesEnabled()
    {
        if (!array_key_exists(EntityDefinitionConfig::DISABLE_META_PROPERTIES, $this->items)) {
            return true;
        }

        return !$this->items[EntityDefinitionConfig::DISABLE_META_PROPERTIES];
    }

    /**
     * Enables a requesting of additional meta properties.
     */
    public function enableMetaProperties()
    {
        $this->items[EntityDefinitionConfig::DISABLE_META_PROPERTIES] = false;
    }

    /**
     * Disables a requesting of additional meta properties.
     */
    public function disableMetaProperties()
    {
        $this->items[EntityDefinitionConfig::DISABLE_META_PROPERTIES] = true;
    }
}
