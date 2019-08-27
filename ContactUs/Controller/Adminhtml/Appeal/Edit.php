<?php
/**
 * ContactUs appeal edit
 */
namespace Smile\ContactUs\Controller\Adminhtml\Appeal;

use Magento\Backend\App\Action;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Smile\ContactUs\Api\AppealRepositoryInterface;

/**
 * Class Edit
 */
class Edit extends Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Smile_ContactUs::appeal_save';

    /**
     * Core registry
     *
     * @var Registry
     */
    private $coreRegistry;

    /**
     * Page factory
     *
     * @var PageFactory
     */
    private $resultPageFactory;

    /**
     * Appeal repository interface
     *
     * @var AppealRepositoryInterface
     */
    private $appealRepository;

    /**
     * Edit constructor
     *
     * @param Action\Context              $context
     * @param PageFactory                 $resultPageFactory
     * @param Registry                    $registry
     * @param AppealRepositoryInterface $appealRepository
     */
    public function __construct(
        Action\Context $context,
        PageFactory $resultPageFactory,
        Registry $registry,
        AppealRepositoryInterface $appealRepository
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->coreRegistry = $registry;
        $this->appealRepository = $appealRepository;
        parent::__construct($context);
    }

    /**
     * Init actions
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    private function _initAction()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Smile_ContactUs::appeal')
            ->addBreadcrumb(__('Smile'), __('Smile'))
            ->addBreadcrumb(__('Manage Appeal'), __('Manage Appeal'));

        return $resultPage;
    }

    /**
     * Edit Appeal page
     *
     * @return \Magento\Backend\Model\View\Result\Page | \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $id = $this->getRequest()->getParam('id');
        $resultPage->getConfig()->getTitle()->prepend(__('Appeal Information'));

        if ($id) {
            try {
                $model = $this->appealRepository->getById($id);
                $resultPage->getConfig()->getTitle()->prepend(__('Edit Appeal'));
            } catch (NoSuchEntityException $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while editing the appeal.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();

                return $resultRedirect->setPath('*/*/');
            }
            $this->coreRegistry->register('contactus_appeal', $model);
        }

        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->_initAction();
        $resultPage->addBreadcrumb(
            $id ? __('Edit Appeal') : __('New Appeal'),
            $id ? __('Edit Appeal') : __('New Appeal')
        );

        return $resultPage;
    }
}
