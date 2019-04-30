<?php
namespace Employee\Form\Block\Adminhtml\Employee\Edit;

/**
 * Class GenericButton
 * @package EC\Downloads\Block\Adminhtml\Categories\Edit
 */
class GenericButton
{

    /**
     * GenericButton constructor.
     * @param \Magento\Backend\Block\Widget\Context $context
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context
    )
    {
        $this->context = $context;
    }

    /**
     * @return string
     */
    public function getBackUrl()
    {
        return $this->getUrl('form/employee/index');
    }

    /**
     * @param string $route
     * @param array $params
     * @return string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }

    /**
     * @return string
     */
    //public function getDeleteUrl()
    //{
        //return $this->getUrl('downloads/categories/delete', ['object_id' => $this->getObjectId()]);
    //}

    /**
     * @return mixed
     */
    public function getObjectId()
    {
        return $this->context->getRequest()->getParam('employee_id');
    }
}
