<?php
namespace TungNguyen\Tags\Controller\Adminhtml\ProductTags;

use TungNguyen\Tags\Model\Tag as Tag;


class Delete extends \Magento\Backend\App\Action
{

    const ADMIN_RESOURCE = 'ProductTags';

    protected $resultPageFactory;
    protected $tagFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \TungNguyen\Tags\Model\TagFactory $tagFactory
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->tagFactory = $tagFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');

        $tag = $this->tagFactory->create()->load($id);

        if(!$tag)
        {
            $this->messageManager->addError(__('Unable to process. please, try again.'));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/', array('_current' => true));
        }

        try{
            $tag->delete();
            $this->messageManager->addSuccess(__('Your tag has been deleted !'));
        }
        catch(\Exception $e)
        {
            $this->messageManager->addError(__('Error while trying to delete tag'));
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index', array('_current' => true));
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/index', array('_current' => true));
    }
}