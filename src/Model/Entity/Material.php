<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Material Entity
 *
 * @property int $id
 * @property string $material_code
 * @property string $material_name
 * @property int $material_category_id
 * @property string|null $uom
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\MaterialCategory $material_category
 * @property \App\Model\Entity\PoFooter[] $po_footers
 * @property \App\Model\Entity\PrFooter[] $pr_footers
 * @property \App\Model\Entity\RfqFooter[] $rfq_footers
 */
class Material extends Entity
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
        'material_code' => true,
        'material_name' => true,
        'material_category_id' => true,
        'uom' => true,
        'created' => true,
        'modified' => true,
        'material_category' => true,
        'po_footers' => true,
        'pr_footers' => true,
        'rfq_footers' => true,
    ];
}
