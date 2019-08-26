<?php
namespace TungNguyen\Tags\Block\Submission;

class Edit extends \Magento\Framework\View\Element\Template
{
	private $tagFactory;
	private $tagRepository;
	private $_coreRegistry;

	public function __construct(\Magento\Framework\View\Element\Template\Context $context, \TungNguyen\Tags\Model\TagFactory $tagFactory, \TungNguyen\Tags\Model\TagRepository $tagRepository, 
		\Magento\Framework\Registry $coreRegistry)

	{
		parent::__construct($context);
		$this->tagFactory = $tagFactory;
		$this->tagRepository = $tagRepository;
		$this->_coreRegistry = $coreRegistry;
	}

	public function getTag()
	{
        $tags_id = $this->_coreRegistry->registry('id');
		$tag = $this->tagRepository->getById($tags_id);
		return $tag;
	}
	public function execute()
	{
		return $this->_pageFactory->create();
	}
}