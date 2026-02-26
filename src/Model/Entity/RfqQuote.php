<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RfqQuote Entity
 *
 * @property int $id
 * @property int $rfq_footer_id
 * @property int $vendor_user_id
 * @property int|null $latest_revision
 * @property int|null $max_revisions
 * @property string|null $quote_status
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 *
 * @property \App\Model\Entity\RfqFooter $rfq_footer
 * @property \App\Model\Entity\RfqQuoteRevision[] $rfq_quote_revisions
 */
class RfqQuote extends Entity
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
        'vendor_user_id' => true,
        'latest_revision' => true,
        'max_revisions' => true,
        'quote_status' => true,
        'created' => true,
        'modified' => true,
        'rfq_footer' => true,
        'rfq_quote_revisions' => true,
    ];
}
