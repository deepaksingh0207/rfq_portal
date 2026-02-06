<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PoFooter Entity
 *
 * @property int $id
 * @property int $po_header_id
 * @property int $rfq_footer_id
 * @property int $material_id
 * @property string $quantity
 * @property string $price
 * @property \Cake\I18n\Date $delivery_date
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\PoHeader $po_header
 * @property \App\Model\Entity\RfqFooter $rfq_footer
 * @property \App\Model\Entity\Material $material
 */
class PoFooter extends Entity
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
        'po_header_id' => true,
        'rfq_footer_id' => true,
        'material_id' => true,
        'quantity' => true,
        'price' => true,
        'delivery_date' => true,
        'created' => true,
        'modified' => true,
        'po_header' => true,
        'rfq_footer' => true,
        'material' => true,
    ];
}
