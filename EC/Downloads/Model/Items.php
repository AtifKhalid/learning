<?php

namespace EC\Downloads\Model;
/**
 * Class Items
 * @package EC\Downloads\Model
 */
class Items extends \Magento\Framework\Model\AbstractModel implements \EC\Downloads\Api\Data\ItemsInterface, \Magento\Framework\DataObject\IdentityInterface
{
    /**
     *
     */
    const CACHE_TAG = 'ec_downloads_items';

    protected $_eventPrefix = 'ec_downloads_items';

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
        $this->_init('EC\Downloads\Model\ResourceModel\Items');
    }
}
