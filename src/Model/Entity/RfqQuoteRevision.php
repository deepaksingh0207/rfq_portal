<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RfqQuoteRevision Entity
 *
 * @property int $id
 * @property int $rfq_quote_id
 * @property int $revision_no
 * @property string|null $unit_price
 * @property string|null $line_total
 * @property \Cake\I18n\Date|null $delivery_date
 * @property string|null $discount_amount
 * @property string|null $installation_charges
 * @property string|null $freight_type
 * @property string|null $freight_value
 * @property string|null $tax_type
 * @property string|null $tax_value
 * @property string|null $warranty_terms
 * @property string|null $vendor_remark
 * @property string|null $sub_total
 * @property string|null $total_amount
 * @property string $rate
 * @property string|null $currency
 * @property int|null $delivery_time_days
 * @property \Cake\I18n\Date|null $validity_date
 * @property string|null $remark
 * @property \Cake\I18n\DateTime|null $submitted_at
 * @property \Cake\I18n\DateTime|null $created
 *
 * @property \App\Model\Entity\RfqQuote $rfq_quote
 */
class RfqQuoteRevision extends Entity
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
        'rfq_quote_id' => true,
        'revision_no' => true,
        'unit_price' => true,
        'line_total' => true,
        'delivery_date' => true,
        'discount_amount' => true,
        'installation_charges' => true,
        'freight_type' => true,
        'freight_value' => true,
        'tax_type' => true,
        'tax_value' => true,
        'warranty_terms' => true,
        'vendor_remark' => true,
        'sub_total' => true,
        'total_amount' => true,
        'rate' => true,
        'currency' => true,
        'delivery_time_days' => true,
        'validity_date' => true,
        'remark' => true,
        'submitted_at' => true,
        'created' => true,
        'rfq_quote' => true,
    ];
}
