<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Vendor Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $sap_code
 * @property string|null $vendor_name
 * @property string|null $vendor_email
 * @property string|null $company_name
 * @property string|null $tax_id
 * @property string|null $registration_number
 * @property string|null $address_line1
 * @property string|null $address_line2
 * @property string|null $city
 * @property string|null $state
 * @property string|null $postal_code
 * @property string|null $country
 * @property string|null $phone
 * @property string|null $fax
 * @property string|null $website
 * @property string|null $contact_person
 * @property string|null $contact_email
 * @property string|null $payment_terms
 * @property string|null $shipping_terms
 * @property string|null $currency
 * @property string|null $bank_name
 * @property string|null $bank_account
 * @property string|null $bank_code
 * @property string|null $rating
 * @property bool|null $is_blacklisted
 * @property string|null $blacklist_reason
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\VendorCategoryMapping[] $vendor_category_mapping
 */
class Vendor extends Entity
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
        'vendor_name' => true,
        'vendor_email' => true,
        'company_name' => true,
        'tax_id' => true,
        'registration_number' => true,
        'address_line1' => true,
        'address_line2' => true,
        'city' => true,
        'state' => true,
        'postal_code' => true,
        'country' => true,
        'phone' => true,
        'fax' => true,
        'website' => true,
        'contact_person' => true,
        'contact_email' => true,
        'payment_terms' => true,
        'shipping_terms' => true,
        'currency' => true,
        'bank_name' => true,
        'bank_account' => true,
        'bank_code' => true,
        'rating' => true,
        'is_blacklisted' => true,
        'blacklist_reason' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'vendor_category_mapping' => true,
    ];
}
