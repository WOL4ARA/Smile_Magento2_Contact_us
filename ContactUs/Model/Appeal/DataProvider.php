<?php
/**
 * ContactUs appeal data provider
 */
namespace Smile\ContactUs\Model\Appeal;

use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Magento\Store\Model\StoreManagerInterface;
use Smile\ContactUs\Model\ResourceModel\Appeal\CollectionFactory;

/**
 * Class DataProvider
 */
class DataProvider extends AbstractDataProvider
{
    /**
     * Appeal collection
     *
     * @var \Smile\ContactUs\Model\ResourceModel\Appeal\Collection
     */
    protected $collection;

    /**
     * Data persistor interface
     *
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * Loaded data
     *
     * @var array
     */
    private $loadedData;

    /**
     * Store manager
     *
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * DataProvider constructor
     *
     * @param string                 $name
     * @param string                 $primaryFieldName
     * @param string                 $requestFieldName
     * @param CollectionFactory      $appealCollectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param StoreManagerInterface  $storeManager
     * @param array                  $meta
     * @param array                  $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $appealCollectionFactory,
        DataPersistorInterface $dataPersistor,
        StoreManagerInterface $storeManager,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $appealCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        $this->storeManager = $storeManager;
        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $meta,
            $data
        );
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if ($this->loadedData === null) {
            $this->loadedData = [];
            $items = $this->collection->getItems();

            foreach ($items as $appeal)
                $this->loadedData[$appeal->getId()] = $appeal->getData();

            $data = $this->dataPersistor->get('smile_contact_us_appeal');
            if (!empty($data)) {
                $appeal = $this->collection->getNewEmptyItem();
                $appeal->setData($data);
                $this->loadedData[$appeal->getId()] = $appeal->getData();
                $this->dataPersistor->clear('smile_contact_us_appeal');
            }
        }

        return $this->loadedData;
    }
}
