<?php

require_once 'Eschrade/Pusher/Pusher.php';

class Eschrade_Pusher_Model_Pusher
{
    const CONFIG_AUTH_KEY   = 'system/pusher/auth_key';
    const CONFIG_SECRET     = 'system/pusher/secret';
    const CONFIG_APP_ID     = 'system/pusher/app_id';
    const CONFIG_ENABLED    = 'system/pusher/enabled';

    protected static $_pusher;
    
    /**
     * @return Pusher
     */
    
    public static function getInstance()
    {
        if (!self::$_pusher instanceof Pusher && Mage::getStoreConfigFlag(self::CONFIG_ENABLED)) {
            $auth_key = Mage::getStoreConfig(self::CONFIG_AUTH_KEY);
            $secret = Mage::getStoreConfig(self::CONFIG_SECRET);
            $app_id = Mage::getStoreConfig(self::CONFIG_APP_ID);
            if ($auth_key && $secret && $app_id) {
                self::$_pusher = new Pusher($auth_key, $secret, $app_id);
            }
        }
        return self::$_pusher;
    }
    
    public function trigger($channels, $event, $data)
    {
        $pusher = self::getInstance();
        if ($pusher instanceof Pusher) {
            $pusher->trigger($channels, $event, $data);
        }
    }
    
}

