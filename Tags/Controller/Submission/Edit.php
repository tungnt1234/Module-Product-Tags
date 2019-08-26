<?php
namespace TungNguyen\Tags\Controller\Submission;

class Edit extends \Magento\Framework\App\Action\Action
{
	protected $_pageFactory;

	protected $_tagFactory;

	protected $_tagRepository;

	protected $_coreRegistry;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $pageFactory,
		\TungNguyen\Tags\Model\TagFactory $tagFactory,
		\TungNguyen\Tags\Model\TagRepository $tagRepository, 
		\Magento\Framework\Registry $coreRegistry
		)
	{
		$this->_pageFactory = $pageFactory;
		$this->_tagFactory = $tagFactory;
		$this->_tagRepository = $tagRepository;
		$this->_coreRegistry = $coreRegistry;

		return parent::__construct($context);
	}

	public function execute()
	{
		$tags_id = $this->getRequest()->getParam('id');
		$this->_coreRegistry->register('id', $tags_id);
		return $this->_pageFactory->create();
	}
}
