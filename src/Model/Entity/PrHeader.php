<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PrHeader Entity
 *
 * @property int $id
 * @property string $pr_number
 * @property \Cake\I18n\Date|null $pr_date
 * @property string|null $requester
 * @property string|null $plant
 * @property string|null $source_type
 * @property string|null $status
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\PrFooter[] $pr_footers
 * @property \App\Model\Entity\RfqHeader[] $rfq_headers
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
        'pr_date' => true,
        'requester' => true,
        'plant' => true,
        'source_type' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'pr_footers' => true,
        'rfq_headers' => true,
    ];
}
