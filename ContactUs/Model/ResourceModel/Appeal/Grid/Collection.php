<?php
/**
 * ContactUs grid appeal collection
 */
namespace Smile\ContactUs\Model\ResourceModel\Appeal\Grid;

use Magento\Framework\Api\Search\AggregationInterface;
use Magento\Framework\Api\Search\SearchResultInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\View\Element\UiComponent\DataProvider\Document;
use Smile\ContactUs\Model\ResourceModel\Appeal;
use Smile\ContactUs\Model\ResourceModel\Appeal\Collection as AppealCollection;

/**
 * Class Collection
 */
class Collection extends AppealCollection implements SearchResultInterface
{
    /**
     * Aggregations
     *
     * @var AggregationInterface
     */
    private $aggregations;

    /**
     * Collection constructor
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init(Document::class, Appeal::class);
    }

    /**
     * Get aggregations
     *
     * @return AggregationInterface
     */
    public function getAggregations()
    {
        return $this->aggregations;
    }

    /**
     * Set aggregations
     *
     * @param AggregationInterface $aggregations
     *
     * @return void
     */
    public function setAggregations($aggregations)
    {
        $this->aggregations = $aggregations;
    }

    /**
     * Get search criteria
     *
     * @return \Magento\Framework\Api\SearchCriteriaInterface|null
     */
    public function getSearchCriteria()
    {
        return null;
    }

    /**
     * Set search criteria
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     *
     * @return $this
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function setSearchCriteria(SearchCriteriaInterface $searchCriteria = null)
    {
        return $this;
    }

    /**
     * Get total count
     *
     * @return int
     */
    public function getTotalCount()
    {
        return $this->getSize();
    }

    /**
     * Set total count
     *
     * @param int $totalCount
     *
     * @return $this
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function setTotalCount($totalCount)
    {
        return $this;
    }

    /**
     * Set items list
     *
     * @param \Magento\Framework\Api\ExtensibleDataInterface[] $items
     *
     * @return $this
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function setItems(array $items = null)
    {
        return $this;
    }
}
