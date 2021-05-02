<?php
/*
 * @version 2.0.0
 * @copyright Copyright (C) 2021 ArtMedia. All rights reserved.
 * @license OSCL, see http://www.oxwallplus.com/oscl
 * @website http://artmedia.biz.pl
 * @author Arkadiusz Tobiasz
 * @email kontakt@artmedia.biz.pl
 */

class CORE_CLASS_EventHandler
{
    use OW_Singleton;

    private $key;
    private $eventManager;
    private $service;
    
    public function __construct() {
        $this->key = CORE_BOL_Service::KEY;
        $this->service = CORE_BOL_Service::getInstance();
        $this->config = OW::getConfig();;
        $this->eventManager = OW::getEventManager();
    }
    
    public function genericInit() {
        $this->eventManager->bind(OW_EventManager::ON_FINALIZE, [$this, "onFinalize"]);
    }

    public function init() {
        $this->genericInit();
    }

    public function onFinalize(OW_Event $event) {
        $document = OW::getDocument();
        $pluginManager = OW::getPluginManager();
        
        $document->addStyleSheet($pluginManager->getPlugin($this->key)->getStaticCssUrl() . 'select2.min.css', 'all', -90);
        $document->addStyleSheet($pluginManager->getPlugin($this->key)->getStaticCssUrl() . 'select2-bootstrap.min.css', 'all', -90);
        
        $document->addScript($pluginManager->getPlugin($this->key)->getStaticJsUrl() . 'select2.min.js', 'text/javascript', (-89));
        
    }

}
