<?php
/**
 * Smile ContactUs Plugin
 */
namespace Smile\ContactUs\Plugin\Controller\Index;

use Magento\Contact\Controller\Index\Post as Contact;
use Magento\Framework\App\Action\Context;
use Smile\ContactUs\Api\AppealRepositoryInterface;
use Smile\ContactUs\Model\AppealFactory;

/**
 * Class BeforeContactUsExecute
 */
class BeforeContactUsExecute
{
    /**
     * Appeal repository interface
     *
     * @var AppealRepositoryInterface
     */

    protected $appealRepository;
    /**
     * Appeal factory
     *
     * @var AppealFactory
     */

    protected $appealFactory;

    /**
     * Message manager
     *
     * @var \Magento\Framework\Message\ManagerInterface
     */
    protected $messageManager;

    public function __construct(
        Context $context,
        AppealRepositoryInterface $appealRepository,
        AppealFactory $appealFactory
    ) {
        $this->appealRepository = $appealRepository;
        $this->appealFactory = $appealFactory;
        $this->messageManager = $context->getMessageManager();
    }
    /**
     * Before "beforeExecute"
     *
     * @param Contact $subject Subject
     */

    public function beforeExecute(Contact $subject)
    {
        try{
            $data = $subject->getRequest()->getPostValue();
            $model = $this->appealFactory->create();
            $model->setData($data);
            $this->appealRepository->save($model);
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }
    }
}
