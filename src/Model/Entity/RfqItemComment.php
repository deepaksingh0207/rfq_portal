<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RfqItemComment Entity
 *
 * @property int $id
 * @property int $rfq_footer_id
 * @property int|null $buyer_user_id
 * @property int|null $vendor_user_id
 * @property string|null $sender_role
 * @property string $message
 * @property \Cake\I18n\DateTime|null $created
 *
 * @property \App\Model\Entity\RfqFooter $rfq_footer
 * @property \App\Model\Entity\Buyer $buyer
 * @property \App\Model\Entity\Vendor $vendor
 */
class RfqItemComment extends Entity
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
        'buyer_user_id' => true,
        'vendor_user_id' => true,
        'sender_role' => true,
        'message' => true,
        'created' => true,
        'rfq_footer' => true,
        'buyer' => true,
        'vendor' => true,
    ];
}
