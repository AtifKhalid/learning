<?php

namespace EC\Downloads\Controller\Adminhtml\Categories;

/**
 * Class Delete
 * @package EC\Downloads\Controller\Adminhtml\Categories
 */
class Delete extends \Magento\Backend\App\Action
{
    /**
     *
     */
    const ADMIN_RESOURCE = 'EC_Downloads::categories';

    /**
     * @var \EC\Downloads\Model\CategoriesRepository
     */
    protected $objectRepository;

    /**
     * Delete constructor.
     * @param \EC\Downloads\Model\CategoriesRepository $objectRepository
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \EC\Downloads\Model\CategoriesRepository $objectRepository,
        \Magento\Backend\App\Action\Context $context
    )
    {
        $this->objectRepository = $objectRepository;

        parent::__construct($context);
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Redirect|\Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('object_id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $this->objectRepository->deleteById($id);
                $this->messageManager->addSuccess(__('You have deleted the Category.'));
                return $resultRedirect->setPath('downloads/index/categories');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('downloads/categories/edit', ['categories_id' => $id]);
            }
        }
        $this->messageManager->addError(__('We can not find an object to delete.'));
        return $resultRedirect->setPath('downloads/index/categories');
    }

}
