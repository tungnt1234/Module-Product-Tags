<?php
namespace TungNguyen\Tags\Model\Tag;

use TungNguyen\Tags\Model\ResourceModel\Tag\CollectionFactory;
use TungNguyen\Tags\Model\Tag;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    protected $collection;
    protected $_loadedData;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $tagCollectionFactory,
        array $meta = [],
        array $data = []
    ){
        $this->collection = $tagCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if(isset($this->_loadedData)) {
            return $this->_loadedData;
        }

        $items = $this->collection->getItems();

        foreach($items as $tag)
        {
            $this->_loadedData[$tag->getId()] = $tag->getData();
        }

        return $this->_loadedData;
    }
}