<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Supplier Entity
 *
 * @property int $id
 * @property string $supplier_code
 * @property string $supplier_name
 * @property string $email
 * @property int $is_active
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\PoHeader[] $po_headers
 * @property \App\Model\Entity\RfqSupplierQuote[] $rfq_supplier_quotes
 * @property \App\Model\Entity\RfqSupplier[] $rfq_suppliers
 */
class Supplier extends Entity
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
        'supplier_code' => true,
        'supplier_name' => true,
        'email' => true,
        'is_active' => true,
        'created' => true,
        'modified' => true,
        'po_headers' => true,
        'rfq_supplier_quotes' => true,
        'rfq_suppliers' => true,
    ];
}
