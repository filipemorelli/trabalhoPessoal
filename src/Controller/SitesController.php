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
     * Copia site
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->set("title", "Sites - Pega Descricao");
        if($this->request->is(["post", "put"]))
        {
            $url            = $this->request->data['Url'];
            $queryRule      = $this->request->data['Query'];
            $descricaoHtml  = $this->siteDescricao($url, $queryRule);
            $this->set("descricaoHtml", $descricaoHtml);
        }
    }

    /**
     * Pega Descricao do site template
     *
     * @params $url [Parametro de url]
     * @params $queryRule [PHPQuery/Jquery para pegar somente o que interessa do site]
     *
     * @return \Cake\Http\Response|void
     */
    private function siteDescricao($url, $queryRule = null)
    {
        //$url = 'http://bhtecnologia.com/projeto-freejobs/';
        //$queryRule = 'body #vantagens';
        $content = $this->phpQuery->getDescription($url, $queryRule);
        $minifyContent = $this->Minify->start($content);
        return $minifyContent;
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
