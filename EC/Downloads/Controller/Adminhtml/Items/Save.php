<?php

namespace EC\Downloads\Controller\Adminhtml\Items;

use Magento\Backend\App\Action;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;
use EC\Downloads\Model\ImageUploader;

class Save extends \Magento\Backend\App\Action
{

    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'EC_Downloads::items';

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var \EC\Downloads\Model\ItemsRepository
     */
    protected $objectRepository;

    /**
     * @param Action\Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param \EC\Downloads\Model\ItemsRepository $objectRepository
     */
    public function __construct(
        Action\Context $context,
        DataPersistorInterface $dataPersistor,
        \EC\Downloads\Model\ItemsRepository $objectRepository,
        ImageUploader $imageUploader
    ) {
        $this->dataPersistor    = $dataPersistor;
        $this->objectRepository  = $objectRepository;
        $this->imageUploader = $imageUploader;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            if (isset($data['is_active']) && $data['is_active'] === 'true') {
                $data['is_active'] = EC\Downloads\Model\Items::STATUS_ENABLED;
            }
            if (empty($data['downloads_id'])) {
                $data['downloads_id'] = null;
            }

            /** @var \EC\Downloads\Model\Items $model */
            $model = $this->_objectManager->create('EC\Downloads\Model\Items');

            $id = $this->getRequest()->getParam('downloads_id');
            if ($id) {
                $model = $this->objectRepository->getById($id);
            }
            $data = $this->_saveImage($data);
            $data = $this->_saveFile($data);
            $model->setData($data);

            try {
                $this->objectRepository->save($model);
                $this->messageManager->addSuccess(__('You saved the thing.'));
                $this->dataPersistor->clear('ec_downloads_items');
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['downloads_id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/index/items');
            } catch (LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the data.'));
            }

            $this->dataPersistor->set('ec_downloads_items', $data);
            return $resultRedirect->setPath('*/items/edit', ['downloads_id' => $this->getRequest()->getParam('downloads_id')]);
        }
        return $resultRedirect->setPath('*/index/items');
    }

    public function _saveImage(array $rawData)
    {
        $data = $rawData;
        if (isset($data['image'][0]['name']) && isset($data['image'][0]['tmp_name'])) {
            $data['image'] =$data['image'][0]['name'];
            $this->imageUploader->moveFileFromTmp($data['image'],'image');
        } elseif (isset($data['image'][0]['image']) && !isset($data['image'][0]['tmp_name'])) {
            $data['image'] = $data['image'][0]['image'];
        } else {
            $data['image'] = '';
        }
        return $data;
    }

    public function _saveFile(array $rawData)
    {
        $data = $rawData;
        if (isset($data['filename'][0]['name']) && isset($data['filename'][0]['tmp_name'])) {
            $data['filename'] =$data['filename'][0]['name'];
            $this->imageUploader->moveFileFromTmp($data['filename'],'filename');
        } elseif (isset($data['filename'][0]['filename']) && !isset($data['filename'][0]['tmp_name'])) {
            $data['filename'] = $data['filename'][0]['filename'];
        } else {
            $data['filename'] = '';
        }
        return $data;
    }
}
