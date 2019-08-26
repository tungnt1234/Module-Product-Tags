<?php
namespace TungNguyen\Tags\Model;

use TungNguyen\Tags\Api\Data\TagInterface;

class Tag extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface, TagInterface
{
	const CACHE_TAG = 'tn_product_tags';

	protected $_cacheTag = 'tn_product_tags';

	protected $_eventPrefix = 'tn_product_tags';

	protected function _construct()
	{
		$this->_init('TungNguyen\Tags\Model\ResourceModel\Tag');
	}

	public function getIdentities()
	{
		return [self::CACHE_TAG . '_' . $this->getId()];
	}

	public function getDefaultValues()
	{
		$values = [];

		return $values;
	}
}
