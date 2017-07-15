<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use phpQuery;

class phpQueryComponent extends Component
{

    public function getDescription($url = null, $queryRule)
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

}
