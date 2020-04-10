<?php
namespace TrainingJaymin\StaticBlock\Controller\Index;

use Magento\Framework\HTTP\PhpEnvironment\RemoteAddress;

class Index extends \Magento\Framework\App\Action\Action
{
    /** @var  \Magento\Framework\View\Result\Page */
    protected $resultPageFactory;
    private $remoteAddress;
    /**      * @param \Magento\Framework\App\Action\Context $context      */
    public function __construct(\Magento\Framework\App\Action\Context $context,
                                RemoteAddress $remoteAddress,
                                \Magento\Framework\View\Result\PageFactory $resultPageFactory)
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->remoteAddress = $remoteAddress;
        parent::__construct($context);
    }
    /**
     * Blog Index, shows a list of recent blog posts.
     *
     * @return \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('Custom Front View'));
        $ip = $this->remoteAddress->getRemoteAddress();
        /*echo "Visitor's IP = ".$ip;
        die;*/
        return $resultPage;
    }
}
