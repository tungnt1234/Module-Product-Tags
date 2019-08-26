<?php
namespace TungNguyen\Tags\Controller\Submission;

class Delete extends \Magento\Framework\App\Action\Action
{
	protected $_pageFactory;

	protected $_tagFactory;

	protected $_tagRepository;

	protected $_coreRegistry;

	protected $resultRedirect;
	private $_cacheTypeList;
	private $_cacheFrontendPool;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $pageFactory,
		\TungNguyen\Tags\Model\TagFactory $tagFactory,
		\TungNguyen\Tags\Model\TagRepository $tagRepository, 
		\Magento\Framework\Registry $coreRegistry, 
		\Magento\Framework\Controller\ResultFactory $result, 
		\Magento\Framework\App\Cache\TypeListInterface $cacheTypeList, 
		\Magento\Framework\App\Cache\Frontend\Pool $cacheFrontendPool
		)
	{
		$this->_pageFactory = $pageFactory;
		$this->_tagFactory = $tagFactory;
		$this->_tagRepository = $tagRepository;
		$this->_coreRegistry = $coreRegistry;
		$this->resultRedirect = $result;
		$this->_cacheTypeList = $cacheTypeList;
        $this->_cacheFrontendPool = $cacheFrontendPool;

		return parent::__construct($context);
	}

	public function execute()
	{
		$tags_id = $this->getRequest()->getParam('tags_id');
		$this->_tagRepository->deleteById($tags_id);
        
        $types = array('config','layout','block_html','collections','reflection','db_ddl','eav','config_integration','config_integration_api','full_page','translate','config_webservice');
		foreach ($types as $type) {
		    $this->_cacheTypeList->cleanType($type);
		}
		foreach ($this->_cacheFrontendPool as $cacheFrontend) {
		    $cacheFrontend->getBackend()->clean();
		}
		
		$resultRedirect = $this->resultRedirectFactory->create();
		$resultRedirect->setPath('tag/submission/index');
		return $resultRedirect;
	}
}