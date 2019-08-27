<?php
/**
 * ContactUs appeal model
 */
namespace Smile\ContactUs\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use Smile\ContactUs\Api\Data\AppealInterface;

/**
 * Class Appeal
 */
class Appeal extends AbstractModel implements AppealInterface, IdentityInterface
{
    /**#@+
     * Appeal Statuses
     */
    const STATUS_ANSWERED = 1;
    const STATUS_NOT_ANSWERED = 0;

    /**#@-*/

    /**
     * ContactUs appeal cache tag
     */
    const CACHE_TAG = 'smile_contact_us_appeal';

    /**
     * Cache tag
     *
     * @var string
     */
    public $cacheTag = 'smile_contact_us_appeal';

    /**
     * Prefix of model events names
     *
     * @var string
     */
    public $eventPrefix = 'smile_contact_us_appeal';

    /**
     * Appeal construct
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('Smile\ContactUs\Model\ResourceModel\Appeal');
    }

    /**
     * Get identities
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * Retrieve appeal id
     *
     * @return int
     */
    public function getId()
    {
        return $this->getData(self::ID);
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * Get e-mail
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->getData(self::EMAIL);
    }

    /**
     * Get Phone Number
     *
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->getData(self::PHONE_NUMBER);
    }

    /**
     * Get Appeal
     *
     * @return string
     */
    public function getAppeal()
    {
        return $this->getData(self::APPEAL);
    }

    /**
     * Get creating time
     *
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * Get status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    /**
     * Get answer
     *
     * @return string
     */
    public function getAnswer()
    {
        return $this->getData(self::ANSWER);
    }

    /**
     * Set ID
     *
     * @param int $id
     *
     * @return AppealInterface
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return AppealInterface
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Set e-mail
     *
     * @param string $email
     *
     * @return AppealInterface
     */
    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }

    /**
     * Set Phone Number
     *
     * @param string $telephone
     *
     * @return AppealInterface
     */
    public function setPhoneNumber($telephone)
    {
        return $this->setData(self::PHONE_NUMBER, $telephone);
    }

    /**
     * Set appeal
     *
     * @param string $comment
     *
     * @return AppealInterface
     */
    public function setAppeal($comment)
    {
        return $this->setData(self::APPEAL, $comment);
    }

    /**
     * Set creating time
     *
     * @param string $createdAt
     *
     * @return AppealInterface
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * Set status
     *
     * @param int $status
     *
     * @return AppealInterface
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * Set answer
     *
     * @param string $answer
     *
     * @return AppealInterface
     */
    public function setAnswer($answer)
    {
        return $this->setData(self::ANSWER, $answer);
    }

    /**
     * Prepare appeal statuses.
     * Available event contact_us_appeal_get_available_statuses to customize statuses.
     *
     * @return array
     */
    public function getAvailableStatuses()
    {
        return [self::STATUS_ANSWERED => __('Answered') , self::STATUS_NOT_ANSWERED => __('Not Answered')];
    }
}
