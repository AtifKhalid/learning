<?php

namespace EC\Downloads\Model\ResourceModel;
/**
 * Class Items
 * @package EC\Downloads\Model\ResourceModel
 */
class Items extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     *
     */
    protected function _construct()
    {
        $this->_init('downloads', 'downloads_id');
    }
}
