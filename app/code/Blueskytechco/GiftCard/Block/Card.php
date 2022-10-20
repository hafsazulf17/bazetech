<?php
namespace Blueskytechco\GiftCard\Block;

use \Magento\Catalog\Block\Product\AbstractProduct;
use \Magento\Widget\Block\BlockInterface;

class Card extends AbstractProduct implements BlockInterface
{
    protected $_template = 'index.phtml';
    protected $_productCollectionFactory;
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        array $data
    ) {
        $this->_productCollectionFactory = $productCollectionFactory;
		parent::__construct($context, $data);
    }

    public function _getProduct() {
		$id = explode(",",$this->getData('product_id'));
		$collection = $this->_productCollectionFactory->create();
		$collection->addAttributeToSelect("*");
		$collection->addAttributeToFilter('entity_id', ['in' => $id]);
		$collection->addAttributeToFilter("type_id", ['in' => 'giftcard']);
		return $collection;
    }
}
