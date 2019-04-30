<?php

namespace EC\Downloads\Ui\Component\Listing\DataProviders\Ec\Downloads;

/**
 * Class Items
 * @package EC\Downloads\Ui\Component\Listing\DataProviders\Ec\Downloads
 */
class Items extends \Magento\Ui\DataProvider\AbstractDataProvider
{

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        \EC\Downloads\Model\ResourceModel\Items\CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    )
    {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
    }
}
