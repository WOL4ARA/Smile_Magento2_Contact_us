<?php
/**
 * ContactUs appeal repository interface
 */
namespace Smile\ContactUs\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Smile\ContactUs\Api\Data\AppealInterface;

/**
 * Interface AppealRepositoryInterface
 */
interface AppealRepositoryInterface
{
    /**
     * Retrieve a appeal by it's id
     *
     * @param $objectId
     *
     * @return AppealRepositoryInterface
     */
    public function getById($objectId);

    /**
     * Retrieve appeal which match a specified criteria.
     *
     * @param SearchCriteriaInterface|null $searchCriteria
     *
     * @return \Magento\Framework\Api\SearchResults
     */
    public function getList(SearchCriteriaInterface $searchCriteria = null);

    /**
     * Save appeal
     *
     * @param AppealInterface $object
     *
     * @return AppealRepositoryInterface
     */
    public function save(AppealInterface $object);

    /**
     * Delete a appeal by its id
     *
     * @param int $objectId
     *
     * @return bool
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function deleteById($objectId);
}
