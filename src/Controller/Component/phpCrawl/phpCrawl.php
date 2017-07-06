<?php

include("libs/PHPCrawler.class.php");

class phpCrawl extends PHPCrawler 
{ 
    function setDirname($dirname)
    {
        $this->dirname = $dirname;
    }

    function setDir($dir)
    {
        $this->dir = $dir;
    }

    function setCompleteUrl($url)
    {
        $this->completeUrl = $url;
    }

    function resetCrawl()
    {
        unset($_SESSION['phpCrawl']);
    }

    function getAllLink(){
        return $_SESSION['phpCrawl'];
    }

    function handleDocumentInfo(PHPCrawlerDocumentInfo $PageInfo) 
    {
        if(!isset($_SESSION['phpCrawl']) || is_null($_SESSION['phpCrawl']))
        {
            $_SESSION['phpCrawl'] = array();
        }
        array_push($_SESSION['phpCrawl'], array(
            'url_link' => $PageInfo->url,
            'content' => $PageInfo->content, 
        ));
    } 
}