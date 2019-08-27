<?php
/**
 * ContactUs appeal status
 */
namespace Smile\ContactUs\Model\Appeal\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Smile\ContactUs\Model\Appeal;

/**
 * Class Status
 */
class Status implements OptionSourceInterface
{
    /**
     * Appeal
     *
     * @var Appeal
     */
    private $appeal;

    /**
     * Status constructor
     *
     * @param Appeal $appeal
     */
    public function __construct(Appeal $appeal)
    {
        $this->appeal = $appeal;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $availableOptions = $this->appeal->getAvailableStatuses();
        $options = [];
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }

        return $options;
    }
}
