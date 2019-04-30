<?php
namespace EC\Downloads\Controller\Adminhtml\Items;

class Index extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'EC_Downloads::items';  
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('*/index/index');
        return $resultRedirect;
    }     
}
