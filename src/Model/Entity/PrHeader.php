<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PrHeader Entity
 *
 * @property int $id
 * @property string $pr_number
 * @property string|null $pr_type
 * @property \Cake\I18n\Date|null $document_date
 * @property string|null $requested_by
 * @property string|null $created_by
 * @property string|null $plant
 * @property string|null $purchasing_group
 * @property string|null $company_code
 * @property string|null $currency
 * @property string|null $total_value
 * @property string|null $status
 * @property \Cake\I18n\DateTime|null $sap_created_at
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 *
 * @property \App\Model\Entity\PrFooter[] $pr_footers
 */
class PrHeader extends Entity
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
        'pr_number' => true,
        'pr_type' => true,
        'document_date' => true,
        'requested_by' => true,
        'created_by' => true,
        'plant' => true,
        'purchasing_group' => true,
        'company_code' => true,
        'currency' => true,
        'total_value' => true,
        'status' => true,
        'sap_created_at' => true,
        'created' => true,
        'modified' => true,
        'pr_footers' => true,
    ];
}
