<?php
/**
 * ContactUs appeal collection
 */
namespace Smile\ContactUs\Model\ResourceModel\Appeal;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 */
class Collection extends AbstractCollection
{
    /**
     * Define resource model
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('Smile\ContactUs\Model\Appeal', 'Smile\ContactUs\Model\ResourceModel\Appeal');
    }
}
