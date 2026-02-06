<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PrFooter Entity
 *
 * @property int $id
 * @property int $pr_header_id
 * @property int|null $line_no
 * @property int|null $material_id
 * @property string|null $description
 * @property string|null $quantity
 * @property string|null $uom
 * @property string|null $estimated_price
 * @property \Cake\I18n\Date|null $required_date
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\PrHeader $pr_header
 * @property \App\Model\Entity\Material $material
 * @property \App\Model\Entity\RfqFooter[] $rfq_footers
 */
class PrFooter extends Entity
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
        'pr_header_id' => true,
        'line_no' => true,
        'material_id' => true,
        'description' => true,
        'quantity' => true,
        'uom' => true,
        'estimated_price' => true,
        'required_date' => true,
        'created' => true,
        'modified' => true,
        'pr_header' => true,
        'material' => true,
        'rfq_footers' => true,
    ];
}
