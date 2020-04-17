<?php
namespace TrainingJaymin\CrudModule\Controller\Adminhtml\Post;

use Magento\Backend\App\Action;
use TrainingJaymin\CrudModule\Model\Post as Post;

class NewAction extends \Magento\Backend\App\Action
{
    /**
     * Edit A Contact Page
     *
     * @return \Magento\Backend\Model\View\Result\Page|\Magento\Backend\Model\View\Result\Redirect
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $this->_view->loadLayout();
        $title = __('Crud');
        $this->_view->getPage()->getConfig()->getTitle()->prepend($title);
        $this->_view->renderLayout();

        $contactDatas = $this->getRequest()->getParam('contact');
        if(is_array($contactDatas))
        {
            //print_r($contactDatas); die;
            $contactDatas['tags'] = implode(",",$contactDatas['tags']);
            $contact = $this->_objectManager->create(Post::class);
            $contact->setData($contactDatas)->save();
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index');
        }
    }
}