<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ProdutosMercado Entity
 *
 * @property int $id
 * @property string $title
 * @property \Cake\I18n\FrozenTime $pubDate
 * @property string $link
 * @property string $content
 * @property string $excerpt
 * @property float $price
 * @property string $ml_category
 * @property string $urlImagem
 * @property string $link_download_produto
 */
class ProdutosMercado extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*'  => true,
        'id' => false
    ];
    protected $_virtual    = ['hash', 'file'];

    protected function _getHash()
    {
        return md5($this->_properties['id'] . $this->_properties['url_download']);
    }

    protected function _getFile()
    {
        return $this->_properties['name_product'] . '.' . $this->_properties['ext'];
    }

}
