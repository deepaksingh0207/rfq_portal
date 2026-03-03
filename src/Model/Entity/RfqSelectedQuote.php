<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RfqSelectedQuote Entity
 *
 * @property int $id
 * @property int $rfq_footer_id
 * @property int $rfq_quote_revision_id
 * @property int $selected_by
 * @property \Cake\I18n\DateTime|null $selected_at
 * @property string|null $approval_status
 * @property \Cake\I18n\DateTime|null $created
 *
 * @property \App\Model\Entity\RfqFooter $rfq_footer
 * @property \App\Model\Entity\RfqQuoteRevision $rfq_quote_revision
 * @property \App\Model\Entity\RfqApproval[] $rfq_approvals
 */
class RfqSelectedQuote extends Entity
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
        'rfq_quote_revision_id' => true,
        'selected_by' => true,
        'selected_at' => true,
        'approval_status' => true,
        'created' => true,
        'rfq_footer' => true,
        'rfq_quote_revision' => true,
        'rfq_approvals' => true,
    ];
}
