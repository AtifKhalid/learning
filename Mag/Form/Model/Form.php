<?php
namespace Mag\Form\Model;
class Form extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
	const CACHE_TAG = 'form_details';

	protected $_cacheTag = 'form_details';

	protected $_eventPrefix = 'form_details';

	protected function _construct()
	{
		$this->_init('Mag\Form\Model\ResourceModel\Form');
	}

	public function getIdentities()
	{
		return [self::CACHE_TAG . '_' . $this->getId()];
	}

	public function getDefaultValues()
	{
		$values = [];

		return $values;
	}
}
