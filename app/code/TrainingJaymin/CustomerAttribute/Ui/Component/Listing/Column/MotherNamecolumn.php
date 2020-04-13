<?php
namespace TrainingJaymin\CustomerAttribute\Ui\Component\Listing\Column;

use TrainingJaymin\CustomerAttribute\Model\MothernameFactory;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Ui\Component\Listing\Columns\Column;

class Pancolumn extends Column
{
    protected $_customerRepository;
    protected $_searchCriteria;
    protected $mothernameFactory;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        CustomerRepositoryInterface $customerRepository,
        SearchCriteriaBuilder $criteria,
        MothernameFactory $mothernameFactory,
        array $components = [],
        array $data = []
    ) {
        $this->_customerRepository = $customerRepository;
        $this->_searchCriteria  = $criteria;
        $this->mothernameFactory = $mothernameFactory;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $customer  = $this->_customerRepository->getById($item["entity_id"]);

                $customer_id = $customer->getId();

                $collection = $this->mothernameFactory->create()->getCollection();
                $collection->addFieldToFilter('customer_id', $customer_id);

                $data = $collection->getFirstItem();

                $item[$this->getData('name')] = $data->getMotherName();
            }
        }
        return $dataSource;
    }
}