<?php
namespace EC\Downloads\Observer\Item;
class SaveListner implements \Magento\Framework\Event\ObserverInterface
{
    public function execute(\Magento\Framework\Event\Observer $observer){
        $object = $observer->getEvent()->getDataObject();
        $downloadcategoriesId = $object->getDownloadcategoriesId();
        if($downloadcategoriesId){
            $arr = '';
            foreach ($downloadcategoriesId as $item){
                $arr .= ','.$item;
            }
            $arr = trim($arr,',');
            $object->setData('downloadcategories_id',$arr);
        }
    }
}
