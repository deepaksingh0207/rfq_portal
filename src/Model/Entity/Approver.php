<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Approver Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $sap_code
 * @property string|null $approver_name
 * @property string|null $approver_email
 * @property string|null $department
 * @property string|null $position
 * @property string|null $approval_limit
 * @property bool|null $can_approve_above_limit
 * @property bool|null $requires_second_approval
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 *
 * @property \App\Model\Entity\User $user
 */
class Approver extends Entity
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
        'user_id' => true,
        'sap_code' => true,
        'approver_name' => true,
        'approver_email' => true,
        'department' => true,
        'position' => true,
        'approval_limit' => true,
        'can_approve_above_limit' => true,
        'requires_second_approval' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
    ];
}
