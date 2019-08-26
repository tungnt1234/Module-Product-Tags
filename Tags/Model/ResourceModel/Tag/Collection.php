<?php
namespace TungNguyen\Tags\Model\ResourceModel\Tag;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'tags_id';
	protected $_eventPrefix = 'tn_product_tags_collection';
	protected $_eventObject = 'product_tags_collection';

	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('TungNguyen\Tags\Model\Tag', 'TungNguyen\Tags\Model\ResourceModel\Tag');
	}
}