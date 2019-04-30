<?php
/**
 * Created by PhpStorm.
 * User: fahad
 * Date: 4/8/19
 * Time: 7:41 PM
 */

namespace EC\Downloads\Controller\Adminhtml\Items;

use Magento\Framework\Controller\ResultFactory;

class Uploadfile extends \Magento\Backend\App\Action
{
    public $imageUploader;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \EC\Downloads\Model\ImageUploader $imageUploader
    )
    {
        parent::__construct($context);
        $this->imageUploader = $imageUploader;
    }

    public function _isAllowed()
    {
        return $this->_authorization->isAllowed('EC_Downloads::items');
    }

    public function execute()
    {
        try {
            $result = $this->imageUploader->saveFileToTmpDir('filename');
            $result['cookie'] = [
                'name' => $this->_getSession()->getName(),
                'value' => $this->_getSession()->getSessionId(),
                'lifetime' => $this->_getSession()->getCookieLifetime(),
                'path' => $this->_getSession()->getCookiePath(),
                'domain' => $this->_getSession()->getCookieDomain(),
            ];
        } catch (\Exception $e) {
            $result = ['error' => $e->getMessage(), 'errorcode' => $e->getCode()];
        }
        return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($result);
    }

}