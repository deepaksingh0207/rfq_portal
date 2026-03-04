<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RfqApproval Entity
 *
 * @property int $id
 * @property int $rfq_selected_quote_id
 * @property int $level_no
 * @property int $approver_user_id
 * @property string|null $status
 * @property string|null $remark
 * @property \Cake\I18n\DateTime|null $action_date
 * @property \Cake\I18n\DateTime|null $created
 *
 * @property \App\Model\Entity\RfqSelectedQuote $rfq_selected_quote
 * @property \App\Model\Entity\Approver $approver
 */
class RfqApproval extends Entity
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
        'rfq_selected_quote_id' => true,
        'level_no' => true,
        'approver_user_id' => true,
        'status' => true,
        'remark' => true,
        'action_date' => true,
        'created' => true,
        'rfq_selected_quote' => true,
        'approver' => true,
    ];
}
