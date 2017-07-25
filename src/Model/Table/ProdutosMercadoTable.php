<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProdutosMercado Model
 *
 * @method \App\Model\Entity\ProdutosMercado get($primaryKey, $options = [])
 * @method \App\Model\Entity\ProdutosMercado newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ProdutosMercado[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ProdutosMercado|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ProdutosMercado patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ProdutosMercado[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ProdutosMercado findOrCreate($search, callable $callback = null, $options = [])
 */
class ProdutosMercadoTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('produtos_mercado');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->dateTime('pubDate')
            ->requirePresence('pubDate', 'create')
            ->notEmpty('pubDate');

        $validator
            ->requirePresence('link', 'create')
            ->notEmpty('link');

        $validator
            ->requirePresence('content', 'create')
            ->notEmpty('content');

        $validator
            ->requirePresence('excerpt', 'create')
            ->notEmpty('excerpt');

        $validator
            ->decimal('price')
            ->requirePresence('price', 'create')
            ->notEmpty('price');

        $validator
            ->requirePresence('ml_category', 'create')
            ->notEmpty('ml_category');

        $validator
            ->requirePresence('link_produto', 'create')
            ->notEmpty('link_produto');

        $validator
            ->requirePresence('link_download_produto', 'create')
            ->notEmpty('link_download_produto');

        return $validator;
    }
}
