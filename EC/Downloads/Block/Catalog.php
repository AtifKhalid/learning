<?php

namespace EC\Downloads\Block;


use Magento\Framework\View\Element\Template;

class Catalog extends \Magento\Framework\View\Element\Template
{
    protected $itemCollectionFactory;
    protected $categoryCollectionFactory;
    public function __construct(
        Template\Context $context,
        \EC\Downloads\Model\ResourceModel\Items\CollectionFactory $itemCollectionFactory,
        \EC\Downloads\Model\ResourceModel\Categories\CollectionFactory $categoryCollectionFactory,
        array $data = []
    )
    {
        $this->itemCollectionFactory = $itemCollectionFactory;
        $this->categoryCollectionFactory = $categoryCollectionFactory;
        parent::__construct($context, $data);
    }

    public function getItemCollection(){
        return $this->itemCollectionFactory->create()
            ->setOrder('sort_order', 'asc')
            ->addFieldToFilter('status',1);
    }

    public function getCategoryCollection(){
        return $this->categoryCollectionFactory->create()
            ->setOrder('sort_order', 'asc')
            ->addFieldToFilter('status',1);
    }

    public function getMediaUrl(){
        return $this->getBaseUrl().'pub/media/EC/Downloads/items';
    }

    public function getFileUrl(){
        return $this->getMediaUrl().'/files/';
    }

    public function getImageUrl(){
        return $this->getMediaUrl().'/images/';
    }
}