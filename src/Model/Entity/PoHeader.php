<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PoHeader Entity
 *
 * @property int $id
 * @property string $po_number
 * @property int $rfq_header_id
 * @property int $supplier_id
 * @property \Cake\I18n\Date $po_date
 * @property string $status
 * @property string $total_value
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\RfqHeader $rfq_header
 * @property \App\Model\Entity\Supplier $supplier
 * @property \App\Model\Entity\PoFooter[] $po_footers
 */
class PoHeader extends Entity
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
        'po_number' => true,
        'rfq_header_id' => true,
        'supplier_id' => true,
        'po_date' => true,
        'status' => true,
        'total_value' => true,
        'created' => true,
        'modified' => true,
        'rfq_header' => true,
        'supplier' => true,
        'po_footers' => true,
    ];
}
