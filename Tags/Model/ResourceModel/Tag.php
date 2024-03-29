<?php
namespace TungNguyen\Tags\Model\ResourceModel;


class Tag extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
	
	public function __construct(
		\Magento\Framework\Model\ResourceModel\Db\Context $context
	)
	{
		parent::__construct($context);
	}
	
	protected function _construct()
	{
		$this->_init('tn_product_tags', 'tags_id');
	}
	
}