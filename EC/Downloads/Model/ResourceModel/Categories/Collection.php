<?php

namespace EC\Downloads\Model\ResourceModel\Categories;
/**
 * Class Collection
 * @package EC\Downloads\Model\ResourceModel\Categories
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     *
     */
    protected function _construct()
    {
        $this->_init('EC\Downloads\Model\Categories', 'EC\Downloads\Model\ResourceModel\Categories');
    }
}