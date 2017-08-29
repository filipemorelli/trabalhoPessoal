<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Filesystem\File;
use Convertio\Convertio;
use Convertio\Exceptions\APIException;
use Convertio\Exceptions\CURLException;

/**
 * Description of DownloadFile
 *
 * @author filipe
 */
class DownloadFileComponent extends Component
{

    /**
     * Download external file per Url
     * @param type $url
     * @param type $fileName
     */
    function downloadExternalFile($url, $fileName)
    {
        try
        {
            $data    = $this->download($url);
            $urlPath = $this->sendToUpload($data, $fileName);
            $this->clearArchiveProblemsFiles($urlPath);
            return $urlPath;
        }
        catch (Exception $exc)
        {
            echo json_encode(array(
                'GetTraceAsString' => $exc->getTraceAsString()
            ));
            exit();
        }
        return false;
    }

    /**
     * Download file by curl
     * @param string $url
     * @return byte
     */
    private function download($url)
    {
        $ch   = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSLVERSION, 3);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    /**
     * get data in bytes and create file in upload webroot
     * @param byte $data
     * @param string $fileName
     * @return string
     */
    private function sendToUpload($data, $fileName)
    {
        $filePath = WWW_ROOT . 'upload' . DS . 'themes' . DS . $fileName;
        $file     = fopen($filePath, "w+");
        fputs($file, $data);
        fclose($file);
        chmod($filePath, 0777);
        return $filePath;
    }

    /**
     * Clear All problematic Files
     * @param array $fileInfo
     */
    private function clearZipProblemsFiles($fileInfo)
    {
        $fullPath = $fileInfo['dirname'] . DS . $fileInfo['basename'];
        $zip      = new \ZipArchive();
        $zip->open($fullPath);
        $zip->deleteName('Visit for More!.url');
        $zip->deleteName('JOJOThemes.com.url');
        $zip->deleteName('changelog.txt');
        $zip->deleteName('JOJOThemes.png');
        $zip->close();
    }

    /**
     * Get RAR file info parse to zip and remove all file problems
     * @param array $fileInfo
     * @return array
     */
    private function clearRarProblemsFiles($fileInfo)
    {
        $path        = $this->parseRarToZip($fileInfo);
        $newFileInfo = pathinfo($path);
        $this->deleteRarFile($fileInfo);
        $this->clearZipProblemsFiles($newFileInfo);
        return $newFileInfo;
    }

    /**
     * Delete rar file, usually after parse to zip
     * @param array $fileInfo
     * @return boolean
     */
    private function deleteRarFile($fileInfo)
    {
        if ($fileInfo['extension'] == 'rar')
        {
            $fullPath = $fileInfo['dirname'] . DS . $fileInfo['basename'];
            return unlink($fullPath);
        }
        return false;
    }

    /**
     * Get a rar file and parse To Zip file
     * @param array $fileInfo
     * @return string [URI path file]
     */
    private function parseRarToZip($fileInfo)
    {
        $fullPath       = $fileInfo['dirname'] . DS . $fileInfo['basename'];
        $fullPathSaving = $fileInfo['dirname'] . DS . $fileInfo['filename'] . '.zip';
        $key            = '8b447eba42ca88c08c61601c9382a99a';
        try
        {
            $API = new Convertio($key);               // You can obtain API Key here: https://convertio.co/api/
            $API->start($fullPath, 'zip')->wait()->download($fullPathSaving);
        }
        catch (APIException $e)
        {
            echo "API Exception: " . $e->getMessage() . " [Code: " . $e->getCode() . "]" . "\n";
        }
        catch (CURLException $e)
        {
            echo "HTTP Connection Exception: " . $e->getMessage() . " [CURL Code: " . $e->getCode() . "]" . "\n";
        }
        catch (Exception $e)
        {
            echo "Miscellaneous Exception occurred: " . $e->getMessage() . "\n";
        }
        return $fullPathSaving;
    }

    /**
     * This function remove all files that is in compresssed file like zip, rar, 7z
     * @param string $namePath
     */
    private function clearArchiveProblemsFiles($namePath)
    {
        $fileInfo = pathinfo($namePath);
        switch ($fileInfo['extension'])
        {
            case 'zip':
                $this->clearZipProblemsFiles($fileInfo);
                break;
            case 'rar':
                $this->clearRarProblemsFiles($fileInfo);
                break;
            default:
                break;
        }
        chmod($namePath, 0777);
    }

}
