<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PrFooter Entity
 *
 * @property int $id
 * @property int $pr_header_id
 * @property string|null $item_number
 * @property string|null $material_code
 * @property string|null $material_description
 * @property string|null $quantity
 * @property string|null $uom
 * @property \Cake\I18n\Date|null $delivery_date
 * @property string|null $plant
 * @property string|null $storage_location
 * @property string|null $material_group
 * @property string|null $estimated_price
 * @property string|null $currency
 * @property string|null $account_assignment_category
 * @property string|null $rfq_status
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 *
 * @property \App\Model\Entity\PrHeader $pr_header
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
        'item_number' => true,
        'material_code' => true,
        'material_description' => true,
        'quantity' => true,
        'uom' => true,
        'delivery_date' => true,
        'plant' => true,
        'storage_location' => true,
        'material_group' => true,
        'estimated_price' => true,
        'currency' => true,
        'account_assignment_category' => true,
        'rfq_status' => true,
        'created' => true,
        'modified' => true,
        'pr_header' => true,
    ];
}
