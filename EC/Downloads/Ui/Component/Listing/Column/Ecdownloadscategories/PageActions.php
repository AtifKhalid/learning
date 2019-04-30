<?php

namespace EC\Downloads\Ui\Component\Listing\Column\Ecdownloadscategories;

/**
 * Class PageActions
 * @package EC\Downloads\Ui\Component\Listing\Column\Ecdownloadscategories
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
                if (isset($item["downloadcategories_id"])) {
                    $id = $item["downloadcategories_id"];
                }
                $item[$name]["view"] = [
                    "href" => $this->getContext()->getUrl(
                        "downloads/categories/edit", ["downloadcategories_id" => $id]),
                    "label" => __("Edit")
                ];
            }
        }

        return $dataSource;
    }

}
