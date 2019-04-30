<?php
namespace Employee\Form\Api;

use Employee\Form\Api\Data\EmployeeInterface;
use Magento\Framework\Api\SearchCriteriaInterface;


interface EmployeeRepositoryInterface
{
    
    public function save(EmployeeInterface $page);

  
    public function getById($id);

   
    public function getList(SearchCriteriaInterface $criteria);

    /**
     * @param CategoriesInterface $page
     * @return mixed
     */
    public function delete(EmployeeInterface $page);

    /**
     * @param $id
     * @return mixed
     */
    public function deleteById($id);
}
