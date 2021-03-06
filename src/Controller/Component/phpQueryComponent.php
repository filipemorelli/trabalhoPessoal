<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Utility\Text;
use phpQuery;

class phpQueryComponent extends Component
{

    public $components = array('Tradutor', 'Minify');

    public function getDescription($url = null, $queryRule = '')
    {
        if (!is_null($url))
        {
            //$url = 'http://www.phonearena.com/phones/manufacturer/';
            include dirname(__FILE__) . '/phpQuery/phpQuery.php';
            $doc      = phpQuery::newDocumentFile($url);
            $document = $doc[$queryRule];
            //remove links e transforma eles em divs
            $document->find('a')->removeAttr('href')->removeAttr('rel')->wrap('<div/>')->contentsUnwrap();
            //remove scripts
            $document->find('script')->remove();
            //remove pixels google leads
            $document->find('img[src*="googleads"]')->remove();
            return pq($document)->html();
        }
        //throw new NotFoundException(__('Imposivel Sem URL')); 
        return false;
    }

    public function getDescriptionFull($url = null, $queryTitulo = null, $queryDescricaoRapida = null, $queryDescricaoCompleta = null)
    {
        if (!is_null($url))
        {
            //$url = 'http://www.phonearena.com/phones/manufacturer/';
            include dirname(__FILE__) . '/phpQuery/phpQuery.php';
            $doc = phpQuery::newDocumentFile($url);

            $titulo            = $this->cleanHtmlDescriptionFull($doc[$queryTitulo]);
            $descricaoRapida   = $this->cleanHtmlDescriptionFull($doc[$queryDescricaoRapida]);
            $descricaoCompleta = $this->cleanHtmlDescriptionFull($doc[$queryDescricaoCompleta]);

            return array(
                'titulo'            => trim(pq($titulo)->text()),
                'descricaoRapida'   => trim(pq($descricaoRapida)->text()),
                'descricaoCompleta' => trim(pq($descricaoCompleta)->html())
            );
        }
        //throw new NotFoundException(__('Imposivel Sem URL')); 
        return false;
    }

    public function getMercadoLivreContentEng($url = null, $queryTitulo = null, $queryDescricaoCompleta = null, $queryImagem = null, $contentImage = false)
    {
        if (!is_null($url))
        {
            //$url = 'http://www.phonearena.com/phones/manufacturer/';
            include_once dirname(__FILE__) . '/phpQuery/phpQuery.php';
            $doc = phpQuery::newDocumentFile($url);

            //traduzir
            $titulo = $this->cleanHtmlMercadoLivreContent($doc[$queryTitulo]);
            
            if ($contentImage)
            {
                $descricaoCompleta = $this->cleanHtmlMercadoLivreContentWithImage($doc[$queryDescricaoCompleta]);
            }
            else
            {
                $descricaoCompleta = $this->cleanHtmlMercadoLivreContent($doc[$queryDescricaoCompleta]);
            }
            $decricaoCompletaMinificada = $this->Minify->start(trim($descricaoCompleta->html()));
            $descricaoCompletaTraduzida = $this->Tradutor->begin($decricaoCompletaMinificada);

            $descricaoRapidaTraduzida = Text::truncate(pq($descricaoCompletaTraduzida)->text(), 300, ['ellipsis' => '...', 'exact' => false]);
            return array(
                'titulo'            => trim(pq($titulo)->text()),
                'descricaoRapida'   => $descricaoRapidaTraduzida,
                'descricaoCompleta' => $this->Minify->start($descricaoCompletaTraduzida),
                'urlImagem'         => $doc[$queryImagem]->attr('src')
            );
        }
        //throw new NotFoundException(__('Imposivel Sem URL')); 
        return false;
    }

    public function getMercadoLivreContentPt($url = null, $queryTitulo = null, $queryDescricaoCompleta = null, $queryImagem = null, $contentImage = false)
    {
        if (!is_null($url))
        {
            //$url = 'http://www.phonearena.com/phones/manufacturer/';
            include_once dirname(__FILE__) . '/phpQuery/phpQuery.php';
            $doc = phpQuery::newDocumentFile($url);

            //traduzir
            $titulo = $this->cleanHtmlMercadoLivreContent($doc[$queryTitulo]);

            if ($contentImage)
            {
                $descricaoCompleta = $this->cleanHtmlMercadoLivreContentWithImage($doc[$queryDescricaoCompleta]);
            }
            else
            {
                $descricaoCompleta = $this->cleanHtmlMercadoLivreContent($doc[$queryDescricaoCompleta]);
            }
            $descricaoRapidaTraduzida = Text::truncate(pq($descricaoCompleta)->text(), 300, ['ellipsis' => '...', 'exact' => false]);
            return array(
                'titulo'            => trim(pq($titulo)->text()),
                'descricaoRapida'   => $descricaoRapidaTraduzida,
                'descricaoCompleta' => $this->Minify->start($descricaoCompleta),
                'urlImagem'         => $doc[$queryImagem]->attr('src')
            );
        }
        //throw new NotFoundException(__('Imposivel Sem URL')); 
        return false;
    }

    private function cleanHtmlDescriptionFull($htmlContent)
    {
        $htmlContent->find('a')->removeAttr('href')->removeAttr('rel')->wrap('<div/>')->contentsUnwrap();
        $htmlContent->find('script')->remove();
        $htmlContent->find('img[src*="googleads"]')->remove();
        return $htmlContent;
    }

    private function cleanHtmlMercadoLivreContent($htmlQuery)
    {
        $htmlQuery->find('img')->remove();
        $htmlQuery->find('a:empty')->remove();
        $htmlQuery->find('a')->removeAttr('href')->removeAttr('rel');
        $htmlQuery->find('br')->remove();
        $htmlQuery->find('script')->remove();
        return $htmlQuery;
    }

    private function cleanHtmlMercadoLivreContentWithImage($htmlQuery)
    {
        $htmlQuery->find('a:empty')->remove();
        $htmlQuery->find('a')->removeAttr('href')->removeAttr('rel');
        $htmlQuery->find('br')->remove();
        $htmlQuery->find('script')->remove();
        return $htmlQuery;
    }

}
