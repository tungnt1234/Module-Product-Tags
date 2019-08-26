<?php
namespace TungNguyen\Tags\Controller\Adminhtml\ProductTags;

class Save extends \Magento\Backend\App\Action
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
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if($data)
        {
            try{
                $id = $data['tags_id'];

                $tag = $this->tagFactory->create()->load($id);

                $data = array_filter($data, function($value) {return $value !== ''; });

                $tag->setData($data);
                $tag->save();
                $this->messageManager->addSuccess(__('Successfully saved the item.'));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                return $resultRedirect->setPath('*/*/');
            }
            catch(\Exception $d)
            {
                $this->messageManager->addError($e->getMessage());
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData($data);
                return $resultRedirect->setPath('*/*/edit', ['id' => $tag->getId()]);
            }
        }

         return $resultRedirect->setPath('*/*/');
    }
}