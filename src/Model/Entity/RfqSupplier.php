<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RfqSupplier Entity
 *
 * @property int $id
 * @property int $rfq_header_id
 * @property int $supplier_id
 * @property \Cake\I18n\DateTime $invited_at
 * @property \Cake\I18n\DateTime $responded_at
 * @property string $response_status
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\RfqHeader $rfq_header
 * @property \App\Model\Entity\Supplier $supplier
 */
class RfqSupplier extends Entity
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
        'supplier_id' => true,
        'invited_at' => true,
        'responded_at' => true,
        'response_status' => true,
        'created' => true,
        'modified' => true,
        'rfq_header' => true,
        'supplier' => true,
    ];
}
