<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProdutosMercadoTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProdutosMercadoTable Test Case
 */
class ProdutosMercadoTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ProdutosMercadoTable
     */
    public $ProdutosMercado;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.produtos_mercado'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ProdutosMercado') ? [] : ['className' => ProdutosMercadoTable::class];
        $this->ProdutosMercado = TableRegistry::get('ProdutosMercado', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ProdutosMercado);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
