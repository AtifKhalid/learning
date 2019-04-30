<?php

namespace EC\Downloads\Block\Adminhtml\Categories\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class DeleteButton
 * @package EC\Downloads\Block\Adminhtml\Categories\Edit
 */
class DeleteButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * @return array
     */
    public function getButtonData()
    {
        if (!$this->getObjectId()) {
            return [];
        }
        return [
            'label' => __('Delete Category'),
            'class' => 'delete',
            'on_click' => 'deleteConfirm( \'' . __(
                    'Are you sure you want to do this?'
                ) . '\', \'' . $this->getDeleteUrl() . '\')',
            'sort_order' => 20,
        ];
    }
}
