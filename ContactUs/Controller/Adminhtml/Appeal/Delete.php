<?php
/**
 * ContactUs appeal delete
 */
namespace Smile\ContactUs\Controller\Adminhtml\Appeal;

use Magento\Backend\App\Action;
use Smile\ContactUs\Api\AppealRepositoryInterface;

/**
 * Class Delete
 */
class Delete extends Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Smile_ContactUs::appeal_delete';

    /**
     * Appeal repository interface
     *
     * @var AppealRepositoryInterface
     */
    private $appealRepository;

    /**
     * Delete constructor
     *
     * @param Action\Context                  $context
     * @param AppealRepositoryInterface $appealRepository
     */
    public function __construct(
        Action\Context                  $context,
        AppealRepositoryInterface $appealRepository
    ) {
        $this->appealRepository = $appealRepository;
        parent::__construct($context);
    }

    /**
     * Delete action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $appealRepository = $this->appealRepository;
                $appealRepository->deleteById($id);
                $this->messageManager->addSuccessMessage(__('The appeal has been deleted.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }
        $this->messageManager->addErrorMessage(__('We can\'t find a appeal to delete.'));

        return $resultRedirect->setPath('*/*/');
    }
}
