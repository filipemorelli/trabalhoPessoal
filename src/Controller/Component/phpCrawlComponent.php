<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
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
        //retira o protocolo
        $urlDirName = str_replace('https://', '', str_replace('http://', '', $url));
        //URL completa até a pasta
        $dirname = TMP . $urlDirName;
        //Cria pasta e ferramentas do cakephp
        $dir = new Folder($dirname, true);
        include dirname(__FILE__) . '/phpCrawl/phpCrawl.php';

        $crawler = new phpCrawl();
        $crawler->resetCrawl();
        $crawler->setDir($dir);
        $crawler->setCompleteUrl($url);

        $crawler->setURL($url); 
        $crawler->addContentTypeReceiveRule("#text/html#");
        if(!is_null($urlRule))
        {
            $crawler->addURLFilterRule("#$url#");
        } 
        $crawler->go();
        echo '<pre>';
        var_dump($crawler->getAllLink());
        echo 'oi';
    }
}