<?php

namespace EC\Downloads\Model;
/**
 * Class Categories
 * @package EC\Downloads\Model
 */
class Categories extends \Magento\Framework\Model\AbstractModel implements \EC\Downloads\Api\Data\CategoriesInterface, \Magento\Framework\DataObject\IdentityInterface
{
    /**
     *
     */
    const CACHE_TAG = 'ec_downloads_categories';

    /**
     * @return array|string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     *
     */
    protected function _construct()
    {
        $this->_init('EC\Downloads\Model\ResourceModel\Categories');
    }
}
