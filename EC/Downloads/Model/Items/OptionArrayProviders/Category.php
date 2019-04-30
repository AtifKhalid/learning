<?php
/**
 * Created by PhpStorm.
 * User: fahad
 * Date: 4/9/19
 * Time: 10:33 PM
 */

namespace EC\Downloads\Model\Items\OptionArrayProviders;

class Category implements \Magento\Framework\Data\OptionSourceInterface
{
    protected $collectionFactory;
    public function __construct(
        \EC\Downloads\Model\ResourceModel\Categories\CollectionFactory $collectionFactory
    )
    {
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @var array
     */
    protected $options;

    public function getOptions()
    {
        $items = $this->collectionFactory->create();
        foreach ($items as $item){
            $option[$item->getId()] = $item->getTitleCategory();
        }
        return $option;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        if ($this->options !== null) {
            return $this->options;
        }

        $options = [];
        foreach ($this->getOptions() as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        $this->options = $options;
        return $this->options;
    }

}