<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RfqFooter Entity
 *
 * @property int $id
 * @property int $rfq_header_id
 * @property int $pr_footer_id
 * @property int $material_id
 * @property string $description
 * @property string $quantity
 * @property string $uom
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\RfqHeader $rfq_header
 * @property \App\Model\Entity\PrFooter $pr_footer
 * @property \App\Model\Entity\Material $material
 * @property \App\Model\Entity\PoFooter[] $po_footers
 * @property \App\Model\Entity\RfqSupplierQuote[] $rfq_supplier_quotes
 */
class RfqFooter extends Entity
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
        'rfq_header_id' => true,
        'pr_footer_id' => true,
        'material_id' => true,
        'description' => true,
        'quantity' => true,
        'uom' => true,
        'created' => true,
        'modified' => true,
        'rfq_header' => true,
        'pr_footer' => true,
        'material' => true,
        'po_footers' => true,
        'rfq_supplier_quotes' => true,
    ];
}
