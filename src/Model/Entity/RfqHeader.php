<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RfqHeader Entity
 *
 * @property int $id
 * @property string $rfq_number
 * @property string $rfq_type
 * @property int $pr_header_id
 * @property \Cake\I18n\Date $rfq_date
 * @property \Cake\I18n\DateTime $bidding_start_at
 * @property \Cake\I18n\DateTime $bidding_end_at
 * @property string $status
 * @property string $created_by
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\PrHeader $pr_header
 * @property \App\Model\Entity\PoHeader[] $po_headers
 * @property \App\Model\Entity\RfqFooter[] $rfq_footers
 * @property \App\Model\Entity\RfqSupplier[] $rfq_suppliers
 */
class RfqHeader extends Entity
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
        'rfq_number' => true,
        'rfq_type' => true,
        'pr_header_id' => true,
        'rfq_date' => true,
        'bidding_start_at' => true,
        'bidding_end_at' => true,
        'status' => true,
        'created_by' => true,
        'created' => true,
        'modified' => true,
        'pr_header' => true,
        'po_headers' => true,
        'rfq_footers' => true,
        'rfq_suppliers' => true,
    ];
}
