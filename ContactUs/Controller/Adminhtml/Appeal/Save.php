<?php
/**
 * ContactUs appeal save
 */
namespace Smile\ContactUs\Controller\Adminhtml\Appeal;

use Magento\Backend\App\Action;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Store\Model\ScopeInterface;
use Smile\ContactUs\Api\AppealRepositoryInterface;
use Smile\ContactUs\Model\AppealFactory;
use Smile\ContactUs\Model\Appeal;

/**
 * Class Save
 */
class Save extends Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Smile_ContactUs::appeal_save';

    /**
     * @var TransportBuilder
     */
    private $transportBuilder;

    /**
     * @var StateInterface
     */
    private $inlineTranslation;

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * Data persistor interface
     *
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * Appeal repository interface
     *
     * @var AppealRepositoryInterface
     */
    private $appealRepository;

    /**
     * Appeal factory
     *
     * @var AppealFactory
     */
    private $appealFactory;

    /**
     * Save constructor
     *
     * @param Action\Context            $context
     * @param DataPersistorInterface    $dataPersistor
     * @param AppealRepositoryInterface $appealRepository
     * @param AppealFactory             $appealFactory
     */
    public function __construct(
        Action\Context $context,
        DataPersistorInterface $dataPersistor,
        StoreManagerInterface $storeManager,
        StateInterface $inlineTranslation,
        TransportBuilder $transportBuilder,
        ScopeConfigInterface $scopeConfig,
        AppealRepositoryInterface $appealRepository,
        AppealFactory $appealFactory
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->transportBuilder = $transportBuilder;
        $this->inlineTranslation = $inlineTranslation;
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
        $this->appealRepository = $appealRepository;
        $this->appealFactory = $appealFactory;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $id = $this->getRequest()->getParam('id');
            try {
                $model = $this->appealRepository->getById($id);
                $model->setData($data);
                if ($data['answer']) {
                    $senderInfo = [
                        'name' => $this->scopeConfig->getValue(
                            'trans_email/ident_support/name',
                            ScopeInterface::SCOPE_STORE
                        ),
                        'email' => $this->scopeConfig->getValue(
                            'trans_email/ident_support/email',
                            ScopeInterface::SCOPE_STORE
                        )
                    ];

                    $this->inlineTranslation->suspend();
                    $this->transportBuilder
                        ->setTemplateIdentifier('appeal_email_template')
                        ->setTemplateOptions(
                            [
                                'area' => \Magento\Framework\App\Area::AREA_ADMINHTML,
                                'store' => $this->storeManager->getStore()->getId(),
                            ]
                        )
                        ->setTemplateVars(
                            [
                                'comment' => $model->getAppeal(),
                                'answer' => $model->getAnswer()
                            ]
                        )
                        ->setFrom($senderInfo)
                        ->addTo($model->getEmail())
                        ->getTransport()
                        ->sendMessage();
                    $this->inlineTranslation->resume();

                    $this->messageManager->addSuccessMessage(__('Email has been sent successfully.'));
                    $model->setStatus(Appeal::STATUS_ANSWERED);
                }
                $this->appealRepository->save($model);
                $this->messageManager->addSuccessMessage(__('Appeal is saved.'));
                $this->dataPersistor->clear('smile_contact_us_appeal');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId()]);
                }

                return $resultRedirect->setPath('*/*/');
            } catch (NoSuchEntityException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong. Please try again later.'));
            }

            $this->dataPersistor->set('smile_contact_us_appeal', $data);

            return $resultRedirect->setPath(
                '*/*/edit',
                ['id' => $this->getRequest()->getParam('id')]
            );
        }

        return $resultRedirect->setPath('*/*/');
    }
}
