<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Utility\Text;
use App\Controller\Component\TradutorComponent;

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
        if ($this->request->is(["post", "put"]))
        {
            $url = $this->request->data['Url'];
            $queryTitulo = $this->request->data['QueryTitulo'];
            $queryDescricaoRapida = $this->request->data['QueryDescricaoRapida'];
            $queryDescricaoCompleta = $this->request->data['QueryDescricaoCompleta'];

            $contents = $this->siteDescricaoCompleta($url, $queryTitulo, $queryDescricaoRapida, $queryDescricaoCompleta);

            $this->set("titulo", $contents['titulo']);
            $this->set("descricaoRapida", $contents['descricaoRapida']);
            $this->set("descricaoCompleta", $contents['descricaoCompleta']);
            $this->set("isPost", 1);
        }
    }
    
    /**
     * 
     */
    public function mercadoLivre()
    {
        
        $this->set("title", "Mercado Livre - Pega Descricao");
        $this->set("isPost", false);
        if ($this->request->is(["post", "put"]))
        {
            $url = $this->request->data['Url'];
            $queryTitulo = $this->request->data['QueryTitulo'];
            $queryDescricaoRapida = $this->request->data['QueryDescricaoRapida'];
            $queryDescricaoCompleta = $this->request->data['QueryDescricaoCompleta'];

            $contents = $this->siteDescricaoMercadoLivre($url, $queryTitulo, $queryDescricaoRapida, $queryDescricaoCompleta);
            
            $titulo = $contents['titulo'];
            $descricaoRapida = Text::truncate($contents['descricaoRapida'], 300, ['ellipsis' => '...','exact' => false]);
            $descricaoCompleta = $contents['descricaoCompleta'];

            
            $this->set("titulo", $titulo);
            $this->set("descricaoRapida", $descricaoRapida);
            $this->set("descricaoCompleta", $descricaoCompleta);
            $this->set("isPost", 1);
        }
    }

    /**
     * Pega Descricao do site template
     *
     * @params $url [Parametro de url]
     * @params $queryRule [PHPQuery/Jquery para pegar somente o que interessa do site]
     *
     * @return array ['titulo', 'descricaoRapida', 'descricaoCompleta']
     */
    private function siteDescricaoCompleta($url, $queryTitulo = null, $queryDescricaoRapida = null, $queryDescricaoCompleta = null)
    {
        //$url = 'http://bhtecnologia.com/projeto-freejobs/';
        //$queryRule = 'body #vantagens';
        $contents = $this->phpQuery->getDescriptionFull($url, $queryTitulo, $queryDescricaoRapida, $queryDescricaoCompleta);
        $contents['descricaoCompleta'] = $this->Minify->start($contents['descricaoCompleta']);
        return $contents;
    }

    /**
     * Pega Descricao do site template
     *
     * @params $url [Parametro de url]
     * @params $queryRule [PHPQuery/Jquery para pegar somente o que interessa do site]
     *
     * @return array ['titulo', 'descricaoRapida', 'descricaoCompleta']
     */
    private function siteDescricaoMercadoLivre($url, $queryTitulo = null, $queryDescricaoRapida = null, $queryDescricaoCompleta = null)
    {
        //$url = 'http://bhtecnologia.com/projeto-freejobs/';
        //$queryRule = 'body #vantagens';
        $contents = $this->phpQuery->getMercadoLivreContent($url, $queryTitulo, $queryDescricaoRapida, $queryDescricaoCompleta);
        return $contents;
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
