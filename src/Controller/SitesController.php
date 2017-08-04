<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Filesystem\File;
use Cake\ORM\Entity;

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
            $url                    = $this->request->data['Url'];
            $queryTitulo            = $this->request->data['QueryTitulo'];
            $queryDescricaoRapida   = $this->request->data['QueryDescricaoRapida'];
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
            $url                    = $this->request->data['Url'];
            $queryTitulo            = $this->request->data['QueryTitulo'];
            $queryDescricaoCompleta = $this->request->data['QueryDescricaoCompleta'];
            $queryImagem            = $this->request->data['QueryImagem'];

            $contents = $this->siteDescricaoMercadoLivre($url, $queryTitulo, $queryDescricaoCompleta, $queryImagem);

            $titulo            = $contents['titulo'];
            $descricaoRapida   = $contents['descricaoRapida'];
            $descricaoCompleta = $contents['descricaoCompleta'];
            $urlImagem         = $contents['urlImagem'];

            $produtosMercadoLivreTable      = TableRegistry::get('ProdutosMercado');
            $produto                        = $produtosMercadoLivreTable->newEntity();
            $produto->title                 = $titulo;
            $produto->link                  = $url;
            $produto->content               = $descricaoCompleta;
            $produto->excerpt               = $descricaoRapida;
            $produto->price                 = $this->request->data['price'];
            $produto->ml_category           = $this->request->data['ml_category'];
            $produto->urlImagem             = $urlImagem;
            $produto->link_download_produto = $this->request->data['link_download_produto'];

            if ($produtosMercadoLivreTable->save($produto))
            {
                $this->Flash->success(__('The produtos mercado has been saved. ' . date('Y-m-d H:i:s')));
            }
            else
            {
                $this->Flash->error(__('The produtos mercado has not been saved.' . date('Y-m-d H:i:s')));
            }
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
        $contents                      = $this->phpQuery->getDescriptionFull($url, $queryTitulo, $queryDescricaoRapida, $queryDescricaoCompleta);
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
    private function siteDescricaoMercadoLivre($url, $queryTitulo = null, $queryDescricaoCompleta = null, $queryImagem = null)
    {
        //$url = 'http://bhtecnologia.com/projeto-freejobs/';
        //$queryRule = 'body #vantagens';
        $contents = $this->phpQuery->getMercadoLivreContent($url, $queryTitulo, $queryDescricaoCompleta, $queryImagem);
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
        $content       = $this->phpQuery->getDescription($url, $queryRule);
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

    /**
     * Importa produto por csv
     * @return array|json
     */
    public function importProducts()
    {
        $this->set("title", "Mercado Livre - Importar Produtos");
        if ($this->request->is(["post", "put"]))
        {
            $upload     = $this->request->data['upload'];
            $separation = $this->request->data['separation'];

            $file           = new File($upload['tmp_name']);
            $file->open('r');
            $content        = $file->read();
            $linhas         = explode(PHP_EOL, $content);
            $linhaPrincipal = array_shift($linhas);
            if (end($linhas) == '')
            {
                array_pop($linhas);
            }
            $celulasPrincipais = explode($separation, $linhaPrincipal);
            for ($i = 0; $i < count($linhas); $i++)
            {
                $result = $this->readLines($celulasPrincipais, $separation, $linhas[$i]);
                if (!$result)
                {
                    echo 'Problema na linha ' . $i;
                    $this->Flash->error(__("Problema na linha $i. " . date('Y-m-d H:i:s')));
                    break;
                }
            }
            $this->Flash->success(__('The produtos mercado has been saved. ' . date('Y-m-d H:i:s')));
        }
    }

    private function readLines($celulasPrincipais, $separation, $linha)
    {
        $produto                   = new Entity();
        $celulas                   = explode($separation, $linha);
        for ($j = 0; $j < count($celulas); $j++)
        {
            $produto->{$celulasPrincipais[$j]} = $celulas[$j];
        }
        $contents           = $this->siteDescricaoMercadoLivre($produto->link, $produto->queryTitulo, $produto->queryDescricaoCompleta, $produto->queryImagem);
        $titulo             = $contents['titulo'];
        $descricaoRapida    = $contents['descricaoRapida'];
        $descricaoCompleta  = $contents['descricaoCompleta'];
        $urlImagem          = $contents['urlImagem'];
        $produto->title     = $titulo;
        $produto->content   = $descricaoCompleta;
        $produto->excerpt   = $descricaoRapida;
        $produto->urlImagem = $urlImagem;
        $produtosMercadoLivreTable = TableRegistry::get('ProdutosMercado');
        return $produtosMercadoLivreTable->save($produto);
    }

}
