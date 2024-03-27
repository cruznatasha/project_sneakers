<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Sneaker Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string $name
 * @property string $color
 * @property \Cake\I18n\FrozenDate $releasedate
 * @property int $brand_id
 *
 * @property \App\Model\Entity\Brand $brand
 * @property \App\Model\Entity\Favorite[] $favorites
 */
class Sneaker extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'created' => true,
        'modified' => true,
        'name' => true,
        'color' => true,
        'releasedate' => true,
        'brand_id' => true,
        'brand' => true,
        'favorites' => true,
    ];
}
