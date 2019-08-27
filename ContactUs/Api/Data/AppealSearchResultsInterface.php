<?php
/**
 * ContactUs appeal search results interface
 */
namespace Smile\ContactUs\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface ContactUsSearchResultsInterface
 */
interface AppealSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get appeal list
     *
     * @return \Smile\ContactUs\Api\Data\AppealInterface[]
     */
    public function getItems();

    /**
     * Set appeal list
     *
     * @param \Smile\ContactUs\Api\Data\AppealInterface[] $items
     *
     * @return AppealSearchResultsInterface
     */
    public function setItems(array $items);
}
