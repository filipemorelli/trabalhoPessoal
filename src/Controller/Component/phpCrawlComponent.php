<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
use phpCrawl;

class phpCrawlComponent extends Component
{
    public function copySite($url = null, $urlRule = null, $themeName = null)
    {
        if(!is_null($url) || !is_null($themeName))
        {
            $this->_copySite($url, $urlRule, $themeName);
        }
        return false;
        //throw new NotFoundException(__('Imposivel Sem URL')); s
    }

    private function _copySite($url = null, $urlRule = null, $themeName = null)
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
        //$crawler->addContentTypeReceiveRule("#text/html#");
        if(!is_null($urlRule))
        {
            $crawler->addURLFilterRule("#$url#");
        } 
        $crawler->go();
        $this->createFile($crawler->getAllLink());
        $zip = $this->ZipFolder($dirname, $themeName);
        var_dump($zip);
        exit();
    }

    private function createFile($paginasSite)
    {
        foreach ($paginasSite as $key => $value)
        {
            $link = str_replace('https://', '', str_replace('http://', '', $value['url_link']));
            if($link == "" || substr($link, -1) == "/")
            {
                $link .= 'index.htm';
            }
            $file = new File(TMP . $link, true, 0755);
            $file->write($value['content']);
            $file->close();
        }
    }

    private function ZipFolder($destination, $name)
    {
        // Initialize archive object
        $zip = new \ZipArchive ();
        echo '<pre>';
        if ($zip->open($destination . $name . '.zip', \ZipArchive::CREATE | \ZipArchive::OVERWRITE)) {
            $source = realpath($destination);
            if (is_dir($source)) {
                $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($source), \RecursiveIteratorIterator::SELF_FIRST);
                foreach ($files as $file) {
                    $file = realpath($file);
                    //var_dump($file);
                    if (is_dir($file)) {
                        $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
                    } else if (is_file($file)) {
                        $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
                    }
                }
            } else if (is_file($source)) {
                $zip->addFromString(basename($source), file_get_contents($source));
            }
        }
        return $zip->close();
    }
}