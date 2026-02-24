<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RfqHeader Entity
 *
 * @property int $id
 * @property string $rfq_number
 * @property string|null $rfq_type
 * @property string|null $purchasing_group
 * @property string|null $company_code
 * @property string|null $plant
 * @property string|null $currency
 * @property string|null $status
 * @property \Cake\I18n\Date|null $rfq_release_date
 * @property \Cake\I18n\Date|null $quotation_deadline
 * @property int|null $created_by_user_id
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 *
 * @property \App\Model\Entity\RfqFooter[] $rfq_footers
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
        'purchasing_group' => true,
        'company_code' => true,
        'plant' => true,
        'currency' => true,
        'status' => true,
        'rfq_release_date' => true,
        'quotation_deadline' => true,
        'created_by_user_id' => true,
        'created' => true,
        'modified' => true,
        'rfq_footers' => true,
    ];
}
