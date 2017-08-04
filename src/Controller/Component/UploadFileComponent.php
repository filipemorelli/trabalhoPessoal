<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Filesystem\File;
use Cake\Filesystem\Folder;
use Cake\Utility\Inflector;

class UploadFileComponent extends Component
{

    public function uploadFile($file = array(), $dir = TMP)
    {
        return $this->_upload($file, $dir);
    }

    private function _upload($fileUpload = array(), $dir)
    {
        $this->checa_dir($dir);
        $fileUpload = $this->checa_nome($fileUpload, $dir);
        return $this->move_arquivos($fileUpload, $dir);
    }

    /**
     * Verifica se o diretório existe, se não ele cria.
     * @access public
     * @param Array $fileUpload
     * @param String $data
     */
    private function checa_dir($dir)
    {
        $folder = new Folder();
        if (!is_dir($dir))
        {
            $folder->create($dir);
        }
    }

    /**
     * Verifica se o nome do arquivo já existe, se existir adiciona um numero ao nome e verifica novamente
     * @access public
     * @param Array $fileUpload
     * @param String $data
     * @return nome da imagem
     */
    public function checa_nome($fileUpload, $dir)
    {
        $fileUpload_info = pathinfo($dir . $fileUpload['name']);
        $fileUpload_nome = $this->trata_nome($fileUpload_info['filename']) . '.' . $fileUpload_info['extension'];
        debug($fileUpload_nome);
        $conta           = 2;
        while (file_exists($dir . $fileUpload_nome))
        {
            $fileUpload_nome = $this->trata_nome($fileUpload_info['filename']) . '-' . $conta;
            $fileUpload_nome .= '.' . $fileUpload_info['extension'];
            $conta++;
            debug($fileUpload_nome);
        }
        $fileUpload['name'] = $fileUpload_nome;
        return $fileUpload;
    }

    /**
     * Trata o nome removendo espaços, acentos e caracteres em maiúsculo.
     * @access public
     * @param Array $fileUpload
     * @param String $data
     */
    public function trata_nome($fileUpload_nome)
    {
        return strtolower(Inflector::slug($fileUpload_nome, '-'));
    }

    /**
     * Move o arquivo para a pasta de destino.
     * @access public
     * @param Array $fileUpload
     * @param String $data
     */
    public function move_arquivos($fileUpload, $dir)
    {
        $arquivo = new File($fileUpload['tmp_name']);
        $arquivo->copy($dir . $fileUpload['name']);
        $arquivo->close();
        return $arquivo;
    }

}
