<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Sites Controller
 *
 *
 * @method \App\Model\Entity\Site[] paginate($object = null, array $settings = [])
 */
class SitesController extends AppController
{
    
    /**
     * Pega Descricao do site template
     *
     * @return \Cake\Http\Response|void
     */
    public function siteDescricao()
    {
        $url = 'http://bhtecnologia.com/projeto-freejobs/';
        $queryRule = 'body #vantagens';
        $content = $this->phpQuery->getDescription($url, $queryRule);
        $minifyContent = $this->Minify->start($content);
        echo '<pre>';
        echo '<textarea>' . $minifyContent . '</textarea>';
        exit();
    }

    /**
     * Copia site
     *
     * @return \Cake\Http\Response|void
     */
    public function siteCopy()
    {
        $url = 'http://localhost/teste-crawl/';
        $this->phpCrawl->copySite($url, null, 'Localhost');
        exit();
    }
}
