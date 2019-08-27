<?php
/**
 * Smile appeal Interface
 */
namespace Smile\ContactUs\Api\Data;
/**
 * Interface AppealInterface
 */
interface AppealInterface
{
    /**
     * Table name
     */
    const TABLE_NAME = 'smile_contact_us_appeal';

    /**#@+
     * Constants defined for keys of data array.
     */
    const ID           = 'id';
    const NAME         = 'name';
    const EMAIL        = 'email';
    const PHONE_NUMBER = 'telephone';
    const APPEAL       = 'comment';
    const CREATED_AT   = 'created_at';
    const STATUS       = 'status';
    const ANSWER       = 'answer';
    /**#@-*/

    /**
     * Get ID
     *
     * @return int
     */
    public function getId();

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Get e-mail
     *
     * @return string
     */
    public function getEmail();

    /**
     * Get phone number
     *
     * @return string
     */
    public function getPhoneNumber();

    /**
     * Get appeal
     *
     * @return string
     */
    public function getAppeal();

    /**
     * Get creating time
     *
     * @return string
     */
    public function getCreatedAt();

    /**
     * Get status
     *
     * @return int
     */
    public function getStatus();

    /**
     * Get answer
     *
     * @return string
     */
    public function getAnswer();

    /**
     * Set ID
     *
     * @param int $id
     *
     * @return AppealInterface
     */
    public function setId($id);

    /**
     * Set name
     *
     * @param string $name
     *
     * @return AppealInterface
     */
    public function setName($name);

    /**
     * Set e-mail
     *
     * @param string $email
     *
     * @return AppealInterface
     */
    public function setEmail($email);

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return AppealInterface
     */
    public function setPhoneNumber($telephone);

    /**
     * Set appeal
     *
     * @param string $comment
     *
     * @return AppealInterface
     */
    public function setAppeal($comment);

    /**
     * Set creating time
     *
     * @param string $createdAt
     *
     * @return AppealInterface
     */
    public function setCreatedAt($createdAt);

    /**
     * Set status
     *
     * @param int $status
     *
     * @return AppealInterface
     */
    public function setStatus($status);

    /**
     * Set answer
     *
     * @param string $answer
     *
     * @return AppealInterface
     */
    public function setAnswer($answer);
}
