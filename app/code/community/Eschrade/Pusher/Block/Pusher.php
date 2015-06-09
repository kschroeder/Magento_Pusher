<?php

class Eschrade_Pusher_Block_Pusher extends Mage_Core_Block_Abstract
{
    
    
    protected function _toHtml()
    {
        if (!Mage::getStoreConfigFlag(Eschrade_Pusher_Model_Pusher::CONFIG_ENABLED)) {
            return '';
        }
        $appId = $this->escapeHtml(Mage::getStoreConfig(Eschrade_Pusher_Model_Pusher::CONFIG_AUTH_KEY));
        return <<<HTML
       <script src="//js.pusher.com/2.2/pusher.min.js"></script>
  <script>

    var pusher = new Pusher('$appId');
  </script>   
HTML;
    }
}