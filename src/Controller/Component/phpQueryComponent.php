<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use App\Controller\Component\TradutorComponent;
use phpQuery;

class phpQueryComponent extends Component
{
    public $components = array('Tradutor');

    public function getDescription($url = null, $queryRule = '')
    {
        if (!is_null($url))
        {
            //$url = 'http://www.phonearena.com/phones/manufacturer/';
            include dirname(__FILE__) . '/phpQuery/phpQuery.php';
            $doc = phpQuery::newDocumentFile($url);
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
            $titulo = $doc[$queryTitulo];
            //remove links e transforma eles em divs
            $titulo->find('a')->removeAttr('href')->removeAttr('rel')->wrap('<div/>')->contentsUnwrap();
            //remove scripts
            $titulo->find('script')->remove();
            //remove pixels google leads
            $titulo->find('img[src*="googleads"]')->remove();
            
            $descricaoRapida = $doc[$queryDescricaoRapida];
            $descricaoRapida->find('a')->removeAttr('href')->removeAttr('rel')->wrap('<div/>')->contentsUnwrap();
            //remove scripts
            $descricaoRapida->find('script')->remove();
            //remove pixels google leads
            $descricaoRapida->find('img[src*="googleads"]')->remove();
            
            
            $descricaoCompleta = $doc[$queryDescricaoCompleta];
            $descricaoCompleta->find('a')->removeAttr('href')->removeAttr('rel')->wrap('<div/>')->contentsUnwrap();
            //remove scripts
            $descricaoCompleta->find('script')->remove();
            //remove pixels google leads
            $descricaoCompleta->find('img[src*="googleads"]')->remove();
            
            return array(
                'titulo' => trim(pq($titulo)->text()),
                'descricaoRapida' => trim(pq($descricaoRapida)->text()),
                'descricaoCompleta' => trim(pq($descricaoCompleta)->html())
            );
        }
        //throw new NotFoundException(__('Imposivel Sem URL')); 
        return false;
    }
    
    public function getMercadoLivreContent($url = null, $queryTitulo = null, $queryDescricaoRapida = null, $queryDescricaoCompleta = null)
    {
        if (!is_null($url))
        {
            //$url = 'http://www.phonearena.com/phones/manufacturer/';
            include dirname(__FILE__) . '/phpQuery/phpQuery.php';
            $doc = phpQuery::newDocumentFile($url);
            
            //traduzir
            
            $titulo = $doc[$queryTitulo];
            //remove as imagem
            $titulo->find('img')->remove();
            $titulo->find('a:empty')->remove();
            $titulo->find('a')->removeAttr('href')->removeAttr('rel');
            $titulo->find('br')->remove();
            $titulo->find('script')->remove();
            
            $descricaoRapida = $doc[$queryDescricaoRapida];
            $descricaoRapida->find('img')->remove();
            $descricaoRapida->find('a:empty')->remove();
            $descricaoRapida->find('a')->removeAttr('href')->removeAttr('rel');
            $descricaoRapida->find('br')->remove();
            $descricaoRapida->find('script')->remove();
            
            
            $descricaoCompleta = $doc[$queryDescricaoCompleta];
            $descricaoCompleta->find('img')->remove();
            $descricaoCompleta->find('a:empty')->remove();
            $descricaoCompleta->find('a')->removeAttr('href')->removeAttr('rel');
            $descricaoCompleta->find('br')->remove();
            $descricaoCompleta->find('script')->remove();
            
            return array(
                'titulo' => trim(pq($titulo)->text()),
                'descricaoRapida' => $this->Tradutor->begin(trim(pq($descricaoRapida)->text())),
                'descricaoCompleta' => $this->Tradutor->begin(trim($descricaoCompleta->html()))
            );
        }
        //throw new NotFoundException(__('Imposivel Sem URL')); 
        return false;
    }

}
