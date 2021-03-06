<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\View\View;
use Cake\I18n\Time;
use Cake\Filesystem\File;
use Cake\Utility\Inflector;

/**
 * ProdutosMercado Controller
 *
 * @property \App\Model\Table\ProdutosMercadoTable $ProdutosMercado
 *
 * @method \App\Model\Entity\ProdutosMercado[] paginate($object = null, array $settings = [])
 */
class ProdutosMercadoController extends AppController
{

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // Permitir aos usuários se registrarem e efetuar logout.
        // Você não deve adicionar a ação de "login" a lista de permissões.
        // Isto pode causar problemas com o funcionamento normal do AuthComponent.
        $this->Auth->allow(['ajaxPesquisarProdutos', 'ajaxBuscaProduto', 'ajaxSendProduct', 'downloadAllProducts']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $produtosMercado = $this->paginate($this->ProdutosMercado);

        $this->set(compact('produtosMercado'));
        $this->set('_serialize', ['produtosMercado']);
    }

    /**
     * View method
     *
     * @param string|null $id Produtos Mercado id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $produtosMercado = $this->ProdutosMercado->get($id, [
            'contain' => []
        ]);

        $this->set('produtosMercado', $produtosMercado);
        $this->set('_serialize', ['produtosMercado']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $produtosMercado = $this->ProdutosMercado->newEntity();
        if ($this->request->is('post'))
        {
            $produtosMercado = $this->ProdutosMercado->patchEntity($produtosMercado, $this->request->getData());
            if ($this->ProdutosMercado->save($produtosMercado))
            {
                $this->Flash->success(__('The produtos mercado has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The produtos mercado could not be saved. Please, try again.'));
        }
        $this->set(compact('produtosMercado'));
        $this->set('_serialize', ['produtosMercado']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Produtos Mercado id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $produtosMercado = $this->ProdutosMercado->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put']))
        {
            $produtosMercado = $this->ProdutosMercado->patchEntity($produtosMercado, $this->request->getData());
            if ($this->ProdutosMercado->save($produtosMercado))
            {
                $this->Flash->success(__('The produtos mercado has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The produtos mercado could not be saved. Please, try again.'));
        }
        $this->set(compact('produtosMercado'));
        $this->set('_serialize', ['produtosMercado']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Produtos Mercado id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $produtosMercado = $this->ProdutosMercado->get($id);
        if ($this->ProdutosMercado->delete($produtosMercado))
        {
            $this->Flash->success(__('The produtos mercado has been deleted.'));
        }
        else
        {
            $this->Flash->error(__('The produtos mercado could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function export()
    {
        $query           = $this->ProdutosMercado->find('all', [
            'conditions' => [
                'ativo' => 1
            ]
        ]);
        $produtos        = $query->all();
        $view            = new View();
        $path            = TMP . 'export-mercadolive-' . date('Y-m-d_H-i-s') . '.xml';
        $headerWordpress = $view->element('wordpress/mercadolivre_header');
        $file            = new File($path, true, '0755');
        $file->open('w');
        $file->append('<?xml version="1.0" encoding="UTF-8" ?>');
        $file->append($headerWordpress);

        foreach ($produtos as $produto)
        {
            $time    = new Time($produto->pubDate);
            $content = $view->element('wordpress/mercadolivre_item');
            $content = str_replace('{{id}}', $produto->id, $content);
            $content = str_replace('{{title}}', htmlspecialchars($produto->title), $content);
            $content = str_replace('{{pubDate}}', $time->format('D, d M Y H:i:s'), $content);
            $content = str_replace('{{post_date}}', $time->format('Y-m-d H:i:s'), $content);
            $content = str_replace('{{content}}', $produto->content, $content);
            $content = str_replace('{{excerpt}}', $produto->excerpt, $content);
            $content = str_replace('{{price}}', $produto->price, $content);
            $content = str_replace('{{urlImagem}}', $produto->urlImagem, $content);
            $content = str_replace('{{categoria_id}}', $produto->ml_category, $content);
            $content = str_replace('{{slug}}', strtolower(Inflector::slug($produto->title, '-')), $content);
            if ($produto->tag)
            {
                $tags    = explode('|', $produto->tag);
                $content = $this->generateTagExport($content, $tags);
            }
            $content = str_replace('{{tag}}', '', $content);
            $file->append($content);
        }
        $footerWordpress = $view->element('wordpress/mercadolivre_footer');
        $file->append($footerWordpress);
        $file->close();
        header('Content-Type: application/xml');
        header('Content-Length: ' . $file->size());
        header('Content-Disposition: attachment; filename=' . $file->name);
        header('Pragma: no-cache');
        readfile($file->path);
        flush();
        $file->delete();
        exit();
        // $file->delete();
    }

    private function generateTagExport($content, $tags)
    {

        foreach ($tags as $tagContent)
        {
            $tag     = '<category domain="product_tag" nicename="' . $tagContent . '"><![CDATA[' . $tagContent . ']]></category>{{tag}}';
            $content = str_replace('{{tag}}', $tag, $content);
        }
        return $content;
    }

    public function pesquisar()
    {
        $hasSearch       = 0;
        $produtosMercado = $this->ProdutosMercado->newEntity();
        if ($this->request->is('post'))
        {
            $titulo          = strtoupper($this->request->data['titulo']);
            //$query = $this->request->query
            $query           = $this->ProdutosMercado->find('all', [
                'fields'     => ['id', 'title'],
                'conditions' => [
                    'UPPER(title) like' => "%$titulo%"
                ],
                'limit'      => 100
            ]);
            $produtosMercado = $query->all();

            $this->set('produtosMercado', $produtosMercado);
            $hasSearch = 1;
        }
        $this->set('hasSearch', $hasSearch);
    }

    public function ajaxPesquisarProdutos()
    {
        header("Access-Control-Allow-Origin: *");
        $this->viewBuilder()->setLayout('ajax');
        $pesquisa = strtoupper($this->request->query['q']);
        $query    = $this->ProdutosMercado->find('all', [
            'fields'     => ['id', 'title'],
            'conditions' => [
                'UPPER(title) like' => "%$pesquisa%"
            ],
            'limit'      => 100
        ]);
        echo json_encode($query->all());
        exit();
    }

    public function ajaxBuscaProduto()
    {
        header("Access-Control-Allow-Origin: *");
        header("Cache-Control: max-age=86400");
        $this->viewBuilder()->setLayout('ajax');
        $id      = $this->request->query['q'];
        $produto = $this->ProdutosMercado->get($id, [
            'fields'  => ['id', 'title', 'link', 'link_download_produto', 'excerpt', 'price', 'ml_category', 'tag', 'name_product', 'url_download'],
            'virtual' => ['hash']
        ]);
        echo json_encode($produto);
        exit();
    }

    function ajaxSendProduct()
    {
        header("Access-Control-Allow-Origin: *");
        //$id           = $this->request->query['q'];
        $id           = 89;
        $url_download = 'http://www49.zippyshare.com/d/QslqsJqy/4844/Flashlight_%5bv4.3%5d.rar';
        $hashProduto  = md5($id . $url_download);
        $produto      = $this->ProdutosMercado->get($id, [
            'fields'  => ['id', 'url_download', 'name_product', 'ext'],
            'virtual' => ['hash', 'file']
        ]);
        if ($produto->name_product && $produto->url_download)
        {
            if ($produto->hash === $hashProduto)
            {
                $this->sendEmailToBuyer($produto->url_download, $produto->file, null);
            }
            else
            {
                echo json_encode([
                    'status' => false,
                    'msg'    => 'product hash error'
                ]);
            }
        }
        else
        {
            echo json_encode([
                'status' => false,
                'msg'    => "There is not name and/or url_download"
            ]);
        }
        exit();
    }

}
