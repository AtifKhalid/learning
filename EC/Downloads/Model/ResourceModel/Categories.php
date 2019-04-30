<?php

namespace EC\Downloads\Model\ResourceModel;
/**
 * Class Categories
 * @package EC\Downloads\Model\ResourceModel
 */
class Categories extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     *
     */
    protected function _construct()
    {
        $this->_init('downloadcategories', 'downloadcategories_id');
    }
}
