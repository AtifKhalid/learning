<?php
namespace EC\Downloads\Controller\Adminhtml\Items;

class Delete extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'EC_Downloads::items';

    /**
     * @var \EC\Downloads\Model\ItemsRepository
     */
    protected $objectRepository;

    /**
     * Delete constructor.
     * @param \EC\Downloads\Model\ItemsRepository $objectRepository
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \EC\Downloads\Model\ItemsRepository $objectRepository,
        \Magento\Backend\App\Action\Context $context
    ) {
        $this->objectRepository = $objectRepository;

        parent::__construct($context);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('object_id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $this->objectRepository->deleteById($id);
                $this->messageManager->addSuccess(__('You have deleted the Item.'));
                return $resultRedirect->setPath('downloads/index/items');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('downloads/items/edit', ['downloads_id' => $id]);
            }
        }
        $this->messageManager->addError(__('We can not find an Item to delete.'));
        return $resultRedirect->setPath('downloads/index/items');
    }
    
}
