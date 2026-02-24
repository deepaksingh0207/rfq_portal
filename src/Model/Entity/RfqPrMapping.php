<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RfqPrMapping Entity
 *
 * @property int $id
 * @property int $rfq_footer_id
 * @property string $pr_number
 * @property string $pr_item_number
 * @property string|null $material_code
 * @property string|null $mapped_quantity
 * @property \Cake\I18n\DateTime|null $created
 *
 * @property \App\Model\Entity\RfqFooter $rfq_footer
 */
class RfqPrMapping extends Entity
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
        'pr_number' => true,
        'pr_item_number' => true,
        'material_code' => true,
        'mapped_quantity' => true,
        'created' => true,
        'rfq_footer' => true,
    ];
}
