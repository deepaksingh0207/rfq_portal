<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RfqSupplierQuote Entity
 *
 * @property int $id
 * @property int $rfq_footer_id
 * @property int $supplier_id
 * @property string $quoted_price
 * @property string $currency
 * @property int $delivery_days
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\RfqFooter $rfq_footer
 * @property \App\Model\Entity\Supplier $supplier
 */
class RfqSupplierQuote extends Entity
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
        'rfq_footer_id' => true,
        'supplier_id' => true,
        'quoted_price' => true,
        'currency' => true,
        'delivery_days' => true,
        'created' => true,
        'modified' => true,
        'rfq_footer' => true,
        'supplier' => true,
    ];
}
