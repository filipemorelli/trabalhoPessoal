<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use phpCrawl;

class phpCrawlComponent extends Component
{
    public function copySite($url = null, $urlRule = null)
    {
        if(!is_null($url))
        {
            $this->_copySite($url, $urlRule);
        }
        //throw new NotFoundException(__('Imposivel Sem URL')); s
    }

    private function _copySite($url = null, $urlRule = null)
    {
        include dirname(__FILE__) . '/phpCrawl/phpCrawl.php';
        $crawler = new phpCrawl();
        $crawler->setURL($url); 
        $crawler->addContentTypeReceiveRule("#text/html#");
        if(!is_null($urlRule))
        {
            $crawler->addURLFilterRule("#$url#");
        } 
        $crawler->go();
    }
}