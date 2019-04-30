<?php

namespace EC\Downloads\Model\ResourceModel\Items;
/**
 * Class Collection
 * @package EC\Downloads\Model\ResourceModel\Items
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     *
     */
    protected function _construct()
    {
        $this->_init('EC\Downloads\Model\Items', 'EC\Downloads\Model\ResourceModel\Items');
    }
}
