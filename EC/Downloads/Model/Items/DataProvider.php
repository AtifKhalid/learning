<?php

namespace EC\Downloads\Model\Items;

use EC\Downloads\Model\ResourceModel\Items\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class DataProvider
 * @package EC\Downloads\Model\Items
 */
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{

    /**
     * @var \EC\Downloads\Model\ResourceModel\Items\Collection
     */
    protected $collection;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var array
     */
    protected $loadedData;

    protected $storeManager;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        DataPersistorInterface $dataPersistor,
        StoreManagerInterface $storeManager,
        array $meta = [],
        array $data = []
    )
    {
        $this->collection = $collectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        $this->storeManager = $storeManager;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->meta = $this->prepareMeta($this->meta);
    }

    /**
     * Prepares Meta
     *
     * @param array $meta
     * @return array
     */
    public function prepareMeta(array $meta)
    {
        return $meta;
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $item) {
            if ($item['image']) {
                $mediaUrl =  $this->getMediaUrl().'images/';
                $img = [];
                $img[0]['image'] = $item['image'];
                $img[0]['url'] = $mediaUrl.$item['image'];
                $item['image'] = $img;
            }
            if ($item['filename']) {
                $mediaUrl =  $this->getMediaUrl().'files/';
                $img = [];
                $img[0]['filename'] = $item['filename'];
                $img[0]['url'] = $mediaUrl.$item['filename'];
                $item['filename'] = $img;
            }
            $this->loadedData[$item->getId()] = $item->getData();
        }
        $data = $this->dataPersistor->get('ec_downloads_items');
        if (!empty($data)) {
            $item = $this->collection->getNewEmptyItem();
            $item->setData($data);
            $this->loadedData[$item->getId()] = $item->getData();
            $this->dataPersistor->clear('ec_downloads_items');
        }
        return $this->loadedData;
    }

    public function getMediaUrl()
    {
        $mediaUrl = $this->storeManager->getStore()
                ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA).'EC/Downloads/items/';
        return $mediaUrl;
    }
}
