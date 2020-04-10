<?php
namespace TrainingJaymin\IpRestriction\Controller\Adminhtml\Post;

use Magento\Backend\App\Action;
use TrainingJaymin\IpRestriction\Model\CustomIpAddress as CustomIpAddress;

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
        $title = __('Ip Address');
        $this->_view->getPage()->getConfig()->getTitle()->prepend($title);
        $this->_view->renderLayout();

        $contactDatas = $this->getRequest()->getParam('contact');
        if(is_array($contactDatas))
        {
            //print_r($contactDatas); die;
            $contact = $this->_objectManager->create(CustomIpAddress::class);
            $contact->setData($contactDatas)->save();
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/index');
        }
    }
}