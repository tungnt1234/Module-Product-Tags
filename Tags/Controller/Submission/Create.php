<?php
namespace TungNguyen\Tags\Controller\Submission;

class Create extends \Magento\Framework\App\Action\Action
{
	protected $_pageFactory;

	protected $_tagFactory;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $pageFactory,
		\TungNguyen\Tags\Model\TagFactory $tagFactory
		)
	{
		$this->_pageFactory = $pageFactory;
		$this->_tagFactory = $tagFactory;
		return parent::__construct($context);
	}

	public function execute()
	{
		return $this->_pageFactory->create();
	}
}