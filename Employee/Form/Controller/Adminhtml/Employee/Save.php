<?php
namespace Employee\Form\Controller\Adminhtml\Employee;

use Magento\Backend\App\Action;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;


class Save extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Employee_Form::employee';

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     *
     */
    protected $employeeModel;

    /**
     * @param Action\Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param \Employee\Form\Model\EmployeeRepository $employeeModel
     */
    public function __construct(
        Action\Context $context,
        DataPersistorInterface $dataPersistor,
        \Employee\Form\Model\Employee $employeeModel
    )
    {
        $this->dataPersistor = $dataPersistor;
        $this->employeeModel = $employeeModel;

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

            if (empty($data['employee_id'])) {
                $data['employee_id'] = null;
            }
            // print_r($data); exit;

            /** @var \Employee\Form\Model\Employee **/
            $model = $this->_objectManager->create('Employee\Form\Model\Employee');

            $id = $this->getRequest()->getParam('employee_id');
            if ($id) {
                $model = $this->employeeModel->getById($id);
            }


            $model->setData($data);

            try {                
                $this->objectRepository->save($model);                
                $this->messageManager->ad4dSuccess(__('You saved the thing.'));
                $this->dataPersistor->clear('employee_form_edit');
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/employee/edit', ['employee_id' => $model->getId(), '_current' => true]);
                }                
                return $resultRedirect->setPath('*/employee/index');
            } catch (LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the data.'));
            }

            $this->dataPersistor->set('employee_form_edit', $data);
            return $resultRedirect->setPath('*/employee/edit', ['employee_id' => $this->getRequest()->getParam('employee_id')]);
        }
        return $resultRedirect->setPath('*/employee/index');
    }
}


