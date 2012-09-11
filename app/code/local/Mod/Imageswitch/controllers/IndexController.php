<?php

class Mod_Imageswitch_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $prod_id  = (int) $this->getRequest()->getParam('prod_id');
        $color_value  = (int) $this->getRequest()->getParam('color_id');
        $product=Mage::getModel('catalog/product')->load($prod_id);
        if($color_value) {
            $allProducts = $product->getTypeInstance(true)->getUsedProducts(null, $product);      
            foreach ($allProducts as $prod) {
                if ($prod->getData('image_storing') && $prod->getColor()==$color_value) { // && $prod->isSaleable()
                    break;
                }
            }          
            $prod_full=Mage::getModel('catalog/product')->load($prod->getId());
            Mage::register('product', $prod_full);
        }
        else {
            Mage::register('product', $product);
        }
        $this->loadLayout();    
        $this->renderLayout();
    }
}
