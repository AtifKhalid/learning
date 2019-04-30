<?php

namespace Mag\Form\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class Save
 * @package EC\Downloads\Controller\Adminhtml\Categories
 */
class Save extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Mag_Form::index';

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var \EC\Downloads\Model\CategoriesRepository
     */
    protected $objectRepository;

    /**
     * @param Action\Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param \EC\Downloads\Model\CategoriesRepository $objectRepository
     */
    public function __construct(
        Action\Context $context,
        DataPersistorInterface $dataPersistor,
        \EC\Downloads\Model\CategoriesRepository $objectRepository
    )
    {
        $this->dataPersistor = $dataPersistor;
        $this->objectRepository = $objectRepository;

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
            //if (isset($data['is_active']) && $data['is_active'] === 'true') {
              //  $data['is_active'] = EC\Downloads\Model\Categories::STATUS_ENABLED;
            //}
            if (empty($data['form_id'])) {
                $data['form_id'] = null;
            }

            /** @var \EC\Downloads\Model\Categories $model */
            $model = $this->_objectManager->create('Mag\Form\Model\Form');

            $id = $this->getRequest()->getParam('form_id');
            if ($id) {
                $model = $this->objectRepository->getById($id);
            }

            $model->setData($data);

            try {
                $this->objectRepository->save($model);
                $this->messageManager->addSuccess(__('You saved the thing.'));
                $this->dataPersistor->clear('form_index');
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/index/edit', ['downloadcategories_id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/index/index');
            } catch (LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the data.'));
            }

            $this->dataPersistor->set('form_index', $data);
            return $resultRedirect->setPath('*/index/edit', ['form_id' => $this->getRequest()->getParam('form_id')]);
        }
        return $resultRedirect->setPath('*/index/index');
    }
}
