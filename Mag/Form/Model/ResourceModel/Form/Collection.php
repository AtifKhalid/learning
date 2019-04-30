<?php
namespace Mag\Form\Model\ResourceModel\Form;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'form_id';
	protected $_eventPrefix = 'form_details_collection';
	protected $_eventObject = 'form_collection';

	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('Mag\Form\Model\Form', 'Mag\Form\Model\ResourceModel\Form');
	}

}
