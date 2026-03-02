<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PrHeaders Model
 *
 * @property \App\Model\Table\PrFootersTable&\Cake\ORM\Association\HasMany $PrFooters
 *
 * @method \App\Model\Entity\PrHeader newEmptyEntity()
 * @method \App\Model\Entity\PrHeader newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\PrHeader> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PrHeader get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\PrHeader findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\PrHeader patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\PrHeader> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\PrHeader|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\PrHeader saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\PrHeader>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PrHeader>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\PrHeader>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PrHeader> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\PrHeader>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PrHeader>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\PrHeader>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PrHeader> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PrHeadersTable extends Table
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

        $this->setTable('pr_headers');
        $this->setDisplayField('pr_number');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('PrFooters', [
            'foreignKey' => 'pr_header_id',
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
            ->scalar('pr_number')
            ->maxLength('pr_number', 20)
            ->requirePresence('pr_number', 'create')
            ->notEmptyString('pr_number')
            ->add('pr_number', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('pr_type')
            ->maxLength('pr_type', 10)
            ->allowEmptyString('pr_type');

        $validator
            ->date('document_date')
            ->allowEmptyDate('document_date');

        $validator
            ->scalar('requested_by')
            ->maxLength('requested_by', 255)
            ->allowEmptyString('requested_by');

        $validator
            ->scalar('created_by')
            ->maxLength('created_by', 50)
            ->allowEmptyString('created_by');

        $validator
            ->scalar('plant')
            ->maxLength('plant', 10)
            ->allowEmptyString('plant');

        $validator
            ->scalar('purchasing_group')
            ->maxLength('purchasing_group', 10)
            ->allowEmptyString('purchasing_group');

        $validator
            ->scalar('company_code')
            ->maxLength('company_code', 10)
            ->allowEmptyString('company_code');

        $validator
            ->scalar('currency')
            ->maxLength('currency', 10)
            ->allowEmptyString('currency');

        $validator
            ->decimal('total_value')
            ->allowEmptyString('total_value');

        $validator
            ->scalar('status')
            ->maxLength('status', 50)
            ->allowEmptyString('status');

        $validator
            ->dateTime('sap_created_at')
            ->allowEmptyDateTime('sap_created_at');

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
        $rules->add($rules->isUnique(['pr_number']), ['errorField' => 'pr_number']);

        return $rules;
    }
}
