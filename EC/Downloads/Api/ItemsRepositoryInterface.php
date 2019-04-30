<?php

namespace EC\Downloads\Api;

use EC\Downloads\Api\Data\ItemsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Interface ItemsRepositoryInterface
 * @package EC\Downloads\Api
 */
interface ItemsRepositoryInterface
{
    /**
     * @param ItemsInterface $page
     * @return mixed
     */
    public function save(ItemsInterface $page);

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id);

    /**
     * @param SearchCriteriaInterface $criteria
     * @return mixed
     */
    public function getList(SearchCriteriaInterface $criteria);

    /**
     * @param ItemsInterface $page
     * @return mixed
     */
    public function delete(ItemsInterface $page);

    /**
     * @param $id
     * @return mixed
     */
    public function deleteById($id);
}
