<?php
namespace TrainingJaymin\CrudModule\Ui\Component\Form;


use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentInterface;
use Magento\Ui\Component\Form\FieldFactory;
use Magento\Ui\Component\Form\Fieldset as BaseFieldset;

class CustomCheckbox extends BaseFieldset
{
    /**
     * @var FieldFactory
     */
    private $fieldFactory;

    public function __construct(
        ContextInterface $context,
        array $components = [],
        array $data = [],
        FieldFactory $fieldFactory)
    {
        parent::__construct($context, $components, $data);
        $this->fieldFactory = $fieldFactory;
    }

    /**
     * Get components
     *
     * @return UiComponentInterface[]
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getChildComponents()
    {
        // $stores = $this->getStoreData();
        $checkBoxes = [['value' => 'Open Source', 'label' => 'Open Source'], ['value' => 'Enterprise', 'label' => 'Enterprise']];

        foreach ($checkBoxes as $checkBox) {
            $storeName = $checkBox['label'];


            $fields[] =
                [
                    'label' => __($checkBox['label']),
                    'formElement' => 'checkbox',
                    'value' => $checkBox['value'],
                ];
        }

        foreach ($fields as $k => $fieldConfig) {
            $fieldInstance = $this->fieldFactory->create();

            $name = $k;

            $fieldInstance->setData(
                [
                    'config' => $fieldConfig,
                    'name' => $name,
                ]
            );

            $fieldInstance->prepare();
            $this->addComponent($name, $fieldInstance);
        }

        return parent::getChildComponents();
    }
}