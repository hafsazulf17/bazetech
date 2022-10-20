<?php
namespace Blueskytechco\GiftCard\Model\Config\Source;

class GiftCard extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\Option\ArrayInterface
{
	protected $_productCollectionFactory;

	public function __construct(
		\Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory
	){
		$this->_productCollectionFactory = $productCollectionFactory;
	}

	public function createProductCollection() {
		$collection = $this->_productCollectionFactory->create();
		$collection->addAttributeToSelect('*');
		$collection->addAttributeToFilter("type_id", ['in' => 'giftcard']);
		return $collection;
	}

	public function toOptionArray() {
		$products = $this->createProductCollection();
		$values = [['value' => '', 'label' => __('Select Product')]];
		foreach ($products as $product) {
			$values[] = ['value' => $product->getId() , 'label' => $product->getName()];
		}
		return $values;
	}
}
