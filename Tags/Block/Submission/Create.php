<?php
namespace TungNguyen\Tags\Block\Submission;
class Create extends \Magento\Framework\View\Element\Template
{
    private $tagFactory;
    private $tagRepository;
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context, 
        \TungNguyen\Tags\Model\TagFactory $tagFactory, 
        \TungNguyen\Tags\Model\TagRepository $tagRepository)
    {
        parent::__construct($context);
        $this->tagFactory = $tagFactory;
        $this->tagRepository = $tagRepository;
    }
}