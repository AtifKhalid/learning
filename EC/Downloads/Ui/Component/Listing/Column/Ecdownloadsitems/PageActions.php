<?php

namespace EC\Downloads\Ui\Component\Listing\Column\Ecdownloadsitems;

/**
 * Class PageActions
 * @package EC\Downloads\Ui\Component\Listing\Column\Ecdownloadsitems
 */
class PageActions extends \Magento\Ui\Component\Listing\Columns\Column
{
    /**
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource["data"]["items"])) {
            foreach ($dataSource["data"]["items"] as & $item) {
                $name = $this->getData("name");
                $id = "X";
                if (isset($item["downloads_id"])) {
                    $id = $item["downloads_id"];
                }
                $item[$name]["view"] = [
                    "href" => $this->getContext()->getUrl(
                    "downloads/items/edit", ["downloads_id" => $id]),
                    "label" => __("Edit")
                ];
            }
        }

        return $dataSource;
    }

}
