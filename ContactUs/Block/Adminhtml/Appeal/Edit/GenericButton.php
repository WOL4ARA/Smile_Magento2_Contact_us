<?php
/**
 * ContactUs appeal generic button
 */
namespace Smile\ContactUs\Block\Adminhtml\Appeal\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Exception\NoSuchEntityException;
use Smile\ContactUs\Api\AppealRepositoryInterface;

/**
 * Class GenericButton
 */
class GenericButton
{
    /**
     * Context
     *
     * @var Context
     */
    private $context;

    /**
     * Appeal repository interface
     *
     * @var AppealRepositoryInterface
     */
    private $appealRepository;

    /**
     * GenericButton constructor
     *
     * @param Context                 $context
     * @param AppealRepositoryInterface $appealRepository
     */
    public function __construct(
        Context $context,
        AppealRepositoryInterface $appealRepository
    ) {
        $this->context = $context;
        $this->appealRepository = $appealRepository;
    }

    /**
     * Get Appeal ID
     *
     * @return int
     */
    public function getAppealId()
    {
        try {
            $modelId = $this->context->getRequest()->getParam('id');

            return $this->appealRepository->getById($modelId)->getId();
        } catch (NoSuchEntityException $e) {
            return null;
        }
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array  $params
     *
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
