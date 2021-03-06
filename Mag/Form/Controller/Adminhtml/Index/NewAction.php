<?php
namespace Mag\Form\Controller\Adminhtml\Index;

/**
 * Class NewAction
 * @package Mag\Form\Controller\Adminhtml\Index
 */
class NewAction extends \Magento\Backend\App\Action
{
    /**
     *
     */
    const ADMIN_RESOURCE = 'Mag_Form::index';
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * NewAction constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory)
    {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {  
   

        return $this->resultPageFactory->create();
    }
}
