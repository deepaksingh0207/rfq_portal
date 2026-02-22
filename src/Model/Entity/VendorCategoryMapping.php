<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * VendorCategoryMapping Entity
 *
 * @property int $id
 * @property int $vendor_id
 * @property int $category_id
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\Vendor $vendor
 * @property \App\Model\Entity\Category $category
 */
class VendorCategoryMapping extends Entity
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
    protected array $_accessible = [
        'vendor_id' => true,
        'category_id' => true,
        'created' => true,
        'modified' => true,
        'vendor' => true,
        'category' => true,
    ];
}
