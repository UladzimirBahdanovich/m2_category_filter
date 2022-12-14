<?php

namespace Bahdanovich\SearchableCategory\Model\Category;

use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory;
use Magento\Framework\Data\OptionSourceInterface;

class CategoryList implements OptionSourceInterface
{
    public function __construct(
        CollectionFactory $collectionFactory
    ) {
        $this->_categoryCollectionFactory = $collectionFactory;

    }
    public function toOptionArray($addEmpty = true)
    {

        $collection = $this->_categoryCollectionFactory->create();
        $collection->addAttributeToSelect('name');//->addRootLevelFilter()->load();
        $options = [];
        if ($addEmpty) {
            $options[] = ['label' => __('-- Please Select a Category --'), 'value' => ''];
        }
        foreach ($collection as $category) {
            $options[] = ['label' => $category->getName(), 'value' => $category->getId()];
        }
        return $options;
    }
}
