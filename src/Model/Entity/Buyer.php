<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Buyer Entity
 *
 * @property int $id
 * @property string $buyer_code
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property bool $is_active
 * @property bool $is_deleted
 * @property \Cake\I18n\DateTime $created_on
 * @property \Cake\I18n\DateTime $updated_on
 */
class Buyer extends Entity
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
        'buyer_code' => true,
        'first_name' => true,
        'last_name' => true,
        'email' => true,
        'is_active' => true,
        'is_deleted' => true,
        'created_on' => true,
        'updated_on' => true,
    ];
}
