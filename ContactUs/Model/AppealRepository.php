<?php
/**
 * ContactUs appeal repository
 */
namespace Smile\ContactUs\Model;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Smile\ContactUs\Api\Data;
use Smile\ContactUs\Api\AppealRepositoryInterface;
use Smile\ContactUs\Model\ResourceModel\Appeal as ResourceAppeal;
use Smile\ContactUs\Model\ResourceModel\Appeal\CollectionFactory as AppealCollectionFactory;

/**
 * Class AppealRepository
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class AppealRepository implements AppealRepositoryInterface
{
    /**
     * Resource appeal
     *
     * @var ResourceAppeal
     */
    private $resource;

    /**
     * Appeal factory
     *
     * @var AppealFactory
     */
    private $appealFactory;

    /**
     * Appeal collection factory
     *
     * @var AppealCollectionFactory
     */
    private $appealCollectionFactory;

    /**
     * Appeal search results interface factory
     *
     * @var AppealSearchResultsInterfaceFactory
     */
    private $searchResultsFactory;

    /**
     * AppealRepository constructor
     *
     * @param ResourceAppeal                         $resource
     * @param AppealFactory                            $appealFactory
     * @param AppealCollectionFactory                  $appealCollectionFactory
     * @param Data\AppealSearchResultsInterfaceFactory $searchResultsFactory
     */
    public function __construct(
        ResourceAppeal $resource,
        AppealFactory $appealFactory,
        AppealCollectionFactory $appealCollectionFactory,
        Data\AppealSearchResultsInterfaceFactory $searchResultsFactory
    ) {
        $this->resource = $resource;
        $this->appealFactory = $appealFactory;
        $this->appealCollectionFactory = $appealCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
    }

    /**
     * Save Appeal data
     *
     * @param \Smile\ContactUs\Api\Data\AppealInterface $appeal
     *
     * @return Appeal
     *
     * @throws CouldNotSaveException
     */
    public function save(Data\AppealInterface $appeal)
    {
        try {
            $this->resource->save($appeal);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $appeal;
    }

    /**
     * Load Appeal data by given Appeal Identity
     *
     * @param string $appealId
     *
     * @return Appeal
     *
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($appealId)
    {
        $appeal = $this->appealFactory->create();
        $this->resource->load($appeal, $appealId);
        if (!$appeal->getId()) {
            throw new NoSuchEntityException(__('Appeal with id "%1" does not exist.', $appealId));
        }

        return $appeal;
    }

    /**
     * Load Appeal data collection by given search criteria
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $criteria
     *
     * @return \Smile\ContactUs\Model\ResourceModel\Appeal\Collection
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function getList(SearchCriteriaInterface $criteria = null)
    {
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);

        $collection = $this->appealCollectionFactory->create();
        foreach ($criteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                $condition = $filter->getConditionType() ?: 'eq';
                $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
            }
        }
        $searchResults->setTotalCount($collection->getSize());
        $collection->setCurPage($criteria->getCurrentPage());
        $collection->setPageSize($criteria->getPageSize());
        $appeal = [];
        /** @var Data\AppealInterface $appealModel */
        foreach ($collection as $appealModel) {
            $appeal[] = $appealModel;
        }
        $searchResults->setItems($appeal);

        return $searchResults;
    }

    /**
     * Delete Appeal
     *
     * @param \Smile\ContactUs\Api\Data\AppealInterface $appeal
     *
     * @return bool
     *
     * @throws CouldNotDeleteException
     */
    public function delete(Data\AppealInterface $appeal)
    {
        try {
            $this->resource->delete($appeal);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }

        return true;
    }

    /**
     * Delete Appeal by given Appeal Identity
     *
     * @param string $appealId
     *
     * @return bool
     *
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($appealId)
    {
        return $this->delete($this->getById($appealId));
    }
}
