<?php
/**
 * ContactUs appeal
 */
namespace Smile\ContactUs\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Appeal
 */
class Appeal extends AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('smile_contact_us_appeal', 'id');
    }
}
