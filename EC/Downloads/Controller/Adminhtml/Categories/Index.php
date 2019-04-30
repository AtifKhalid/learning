<?php

namespace EC\Downloads\Controller\Adminhtml\Categories;

/**
 * Class Index
 * @package EC\Downloads\Controller\Adminhtml\Categories
 */
class Index extends \Magento\Backend\App\Action
{
    /**
     *
     */
    const ADMIN_RESOURCE = 'EC_Downloads::categories';

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('*/index/index');
        return $resultRedirect;
    }
}
