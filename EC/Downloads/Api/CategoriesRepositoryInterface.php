<?php

namespace EC\Downloads\Api;

use EC\Downloads\Api\Data\CategoriesInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Interface CategoriesRepositoryInterface
 * @package EC\Downloads\Api
 */
interface CategoriesRepositoryInterface
{
    /**
     * @param CategoriesInterface $page
     * @return mixed
     */
    public function save(CategoriesInterface $page);

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
     * @param CategoriesInterface $page
     * @return mixed
     */
    public function delete(CategoriesInterface $page);

    /**
     * @param $id
     * @return mixed
     */
    public function deleteById($id);
}
