<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Vendors Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Vendor newEmptyEntity()
 * @method \App\Model\Entity\Vendor newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Vendor> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Vendor get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Vendor findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Vendor patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Vendor> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Vendor|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Vendor saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Vendor>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Vendor>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Vendor>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Vendor> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Vendor>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Vendor>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Vendor>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Vendor> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class VendorsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('vendors');
        $this->setDisplayField('sap_code');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('VendorCategoryMappings', [
            'foreignKey' => 'vendor_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('user_id')
            ->notEmptyString('user_id')
            ->add('user_id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('sap_code')
            ->maxLength('sap_code', 50)
            ->requirePresence('sap_code', 'create')
            ->notEmptyString('sap_code')
            ->add('sap_code', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('vendor_name')
            ->maxLength('vendor_name', 500)
            ->allowEmptyString('vendor_name');

        $validator
            ->scalar('vendor_email')
            ->maxLength('vendor_email', 150)
            ->allowEmptyString('vendor_email');

        $validator
            ->scalar('company_name')
            ->maxLength('company_name', 255)
            ->allowEmptyString('company_name');

        $validator
            ->scalar('tax_id')
            ->maxLength('tax_id', 50)
            ->allowEmptyString('tax_id');

        $validator
            ->scalar('registration_number')
            ->maxLength('registration_number', 100)
            ->allowEmptyString('registration_number');

        $validator
            ->scalar('address_line1')
            ->maxLength('address_line1', 255)
            ->allowEmptyString('address_line1');

        $validator
            ->scalar('address_line2')
            ->maxLength('address_line2', 255)
            ->allowEmptyString('address_line2');

        $validator
            ->scalar('city')
            ->maxLength('city', 100)
            ->allowEmptyString('city');

        $validator
            ->scalar('state')
            ->maxLength('state', 100)
            ->allowEmptyString('state');

        $validator
            ->scalar('postal_code')
            ->maxLength('postal_code', 20)
            ->allowEmptyString('postal_code');

        $validator
            ->scalar('country')
            ->maxLength('country', 100)
            ->allowEmptyString('country');

        $validator
            ->scalar('phone')
            ->maxLength('phone', 20)
            ->allowEmptyString('phone');

        $validator
            ->scalar('fax')
            ->maxLength('fax', 20)
            ->allowEmptyString('fax');

        $validator
            ->scalar('website')
            ->maxLength('website', 255)
            ->allowEmptyString('website');

        $validator
            ->scalar('contact_person')
            ->maxLength('contact_person', 255)
            ->allowEmptyString('contact_person');

        $validator
            ->scalar('contact_email')
            ->maxLength('contact_email', 255)
            ->allowEmptyString('contact_email');

        $validator
            ->scalar('payment_terms')
            ->allowEmptyString('payment_terms');

        $validator
            ->scalar('shipping_terms')
            ->allowEmptyString('shipping_terms');

        $validator
            ->scalar('currency')
            ->maxLength('currency', 3)
            ->allowEmptyString('currency');

        $validator
            ->scalar('bank_name')
            ->maxLength('bank_name', 255)
            ->allowEmptyString('bank_name');

        $validator
            ->scalar('bank_account')
            ->maxLength('bank_account', 100)
            ->allowEmptyString('bank_account');

        $validator
            ->scalar('bank_code')
            ->maxLength('bank_code', 50)
            ->allowEmptyString('bank_code');

        $validator
            ->decimal('rating')
            ->allowEmptyString('rating');

        $validator
            ->boolean('is_blacklisted')
            ->allowEmptyString('is_blacklisted');

        $validator
            ->scalar('blacklist_reason')
            ->allowEmptyString('blacklist_reason');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['user_id']), ['errorField' => 'user_id']);
        $rules->add($rules->isUnique(['sap_code']), ['errorField' => 'sap_code']);
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}
