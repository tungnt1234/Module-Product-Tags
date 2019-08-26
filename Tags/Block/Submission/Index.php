<?php
namespace TungNguyen\Tags\Block\Submission;
class Index extends \Magento\Framework\View\Element\Template
{
	private $tagFactory;
	private $tagRepository;
	protected $_registry;
	protected $customer;
	protected $_customerRepository;



	public function __construct(
		\Magento\Framework\View\Element\Template\Context $context, 
		\TungNguyen\Tags\Model\TagFactory $tagFactory, 
		\TungNguyen\Tags\Model\TagRepository $tagRepository,
		\Magento\Customer\Model\Session $customer,
		\Magento\Customer\Api\CustomerRepositoryInterface $customerRepository,
		\Magento\Framework\Registry $registry
		)
	{
		parent::__construct($context);
		$this->tagFactory = $tagFactory;
		$this->tagRepository = $tagRepository;
		$this->_registry = $registry;
		$this->customer = $customer;
        $this->_customerRepository = $customerRepository;

	}

	public function getTags()
	{
		$collection = $this->tagRepository->getList();
		// $collection = $post->getCollection();
		return $collection;
	}

	public function getCurrentProduct()
    {       
        return $this->_registry->registry('current_product');
    }

    public function getCustomer(){
        $customerId = $this->customer->getId();
        $customer = $this->_customerRepository->getById($customerId);
        return $customer;
    }

}