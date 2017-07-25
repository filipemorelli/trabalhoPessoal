<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ProdutosMercado Controller
 *
 * @property \App\Model\Table\ProdutosMercadoTable $ProdutosMercado
 *
 * @method \App\Model\Entity\ProdutosMercado[] paginate($object = null, array $settings = [])
 */
class ProdutosMercadoController extends AppController
{

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
        if ($this->request->is('post')) {
            $produtosMercado = $this->ProdutosMercado->patchEntity($produtosMercado, $this->request->getData());
            if ($this->ProdutosMercado->save($produtosMercado)) {
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
        if ($this->request->is(['patch', 'post', 'put'])) {
            $produtosMercado = $this->ProdutosMercado->patchEntity($produtosMercado, $this->request->getData());
            if ($this->ProdutosMercado->save($produtosMercado)) {
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
        if ($this->ProdutosMercado->delete($produtosMercado)) {
            $this->Flash->success(__('The produtos mercado has been deleted.'));
        } else {
            $this->Flash->error(__('The produtos mercado could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
