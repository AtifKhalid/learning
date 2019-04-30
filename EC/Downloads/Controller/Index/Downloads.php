<?php
/**
 * Created by PhpStorm.
 * User: fahad
 * Date: 4/12/19
 * Time: 11:26 PM
 */

namespace EC\Downloads\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Filesystem\DirectoryList;

/**
 * Class Downloads
 * @package EC\Downloads\Controller\Index
 */
class Downloads extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\App\Response\Http\FileFactory
     */
    protected $fileFactory;

    /**
     * Downloads constructor.
     * @param \Magento\Framework\App\Response\Http\FileFactory $fileFactory
     * @param DirectoryList $directory
     * @param Context $context
     */
    public function __construct(
        \Magento\Framework\App\Response\Http\FileFactory $fileFactory,
        DirectoryList $directory,
        Context $context
    )
    {
        $this->fileFactory = $fileFactory;
        $this->directory = $directory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     * @throws \Exception
     */
    public function execute()
    {
        $file = $this->getRequest()->getParam('file');
        if ($file) {
            $path = "EC/Downloads/items/files/" . $file;
            return $this->fileFactory->create(
                $file,
                [
                    'type' => 'filename',
                    'value' => $path,
                    'rm' => FALSE,
                ],
                \Magento\Framework\App\Filesystem\DirectoryList::MEDIA
            );
        }
    }

}