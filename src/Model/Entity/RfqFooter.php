<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RfqFooter Entity
 *
 * @property int $id
 * @property int $rfq_header_id
 * @property string|null $item_no
 * @property string|null $material_code
 * @property string|null $model
 * @property string|null $part_name
 * @property string|null $make
 * @property string|null $material_description
 * @property string|null $material_group
 * @property int|null $category_id
 * @property string|null $quantity
 * @property string|null $uom
 * @property \Cake\I18n\Date|null $delivery_date
 * @property string|null $specification
 * @property string|null $specification_attachment
 * @property string|null $remark
 * @property string|null $plant
 * @property string|null $source_type
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 *
 * @property \App\Model\Entity\RfqHeader $rfq_header
 * @property \App\Model\Entity\Category $category
 * @property \App\Model\Entity\RfqFooterVendor[] $rfq_footer_vendors
 * @property \App\Model\Entity\RfqManualMaterial[] $rfq_manual_materials
 * @property \App\Model\Entity\RfqPrMapping[] $rfq_pr_mappings
 */
class RfqFooter extends Entity
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
        'item_no' => true,
        'material_code' => true,
        'model' => true,
        'part_name' => true,
        'make' => true,
        'material_description' => true,
        'material_group' => true,
        'category_id' => true,
        'quantity' => true,
        'uom' => true,
        'delivery_date' => true,
        'specification' => true,
        'specification_attachment' => true,
        'remark' => true,
        'plant' => true,
        'source_type' => true,
        'created' => true,
        'modified' => true,
        'rfq_header' => true,
        'category' => true,
        'rfq_footer_vendors' => true,
        'rfq_manual_materials' => true,
        'rfq_pr_mappings' => true,
    ];
}
