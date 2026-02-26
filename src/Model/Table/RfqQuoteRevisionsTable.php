<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RfqQuoteRevisions Model
 *
 * @property \App\Model\Table\RfqQuotesTable&\Cake\ORM\Association\BelongsTo $RfqQuotes
 *
 * @method \App\Model\Entity\RfqQuoteRevision newEmptyEntity()
 * @method \App\Model\Entity\RfqQuoteRevision newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\RfqQuoteRevision> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RfqQuoteRevision get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\RfqQuoteRevision findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\RfqQuoteRevision patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\RfqQuoteRevision> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\RfqQuoteRevision|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\RfqQuoteRevision saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\RfqQuoteRevision>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RfqQuoteRevision>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RfqQuoteRevision>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RfqQuoteRevision> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RfqQuoteRevision>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RfqQuoteRevision>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RfqQuoteRevision>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RfqQuoteRevision> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RfqQuoteRevisionsTable extends Table
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

        $this->setTable('rfq_quote_revisions');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('RfqQuotes', [
            'foreignKey' => 'rfq_quote_id',
            'joinType' => 'INNER',
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
            ->integer('rfq_quote_id')
            ->notEmptyString('rfq_quote_id');

        $validator
            ->integer('revision_no')
            ->requirePresence('revision_no', 'create')
            ->notEmptyString('revision_no');

        $validator
            ->decimal('unit_price')
            ->allowEmptyString('unit_price');

        $validator
            ->decimal('line_total')
            ->allowEmptyString('line_total');

        $validator
            ->date('delivery_date')
            ->allowEmptyDate('delivery_date');

        $validator
            ->decimal('discount_amount')
            ->allowEmptyString('discount_amount');

        $validator
            ->decimal('installation_charges')
            ->allowEmptyString('installation_charges');

        $validator
            ->scalar('freight_type')
            ->maxLength('freight_type', 15)
            ->allowEmptyString('freight_type');

        $validator
            ->decimal('freight_value')
            ->allowEmptyString('freight_value');

        $validator
            ->scalar('tax_type')
            ->maxLength('tax_type', 15)
            ->allowEmptyString('tax_type');

        $validator
            ->decimal('tax_value')
            ->allowEmptyString('tax_value');

        $validator
            ->scalar('warranty_terms')
            ->maxLength('warranty_terms', 1000)
            ->allowEmptyString('warranty_terms');

        $validator
            ->scalar('vendor_remark')
            ->maxLength('vendor_remark', 1000)
            ->allowEmptyString('vendor_remark');

        $validator
            ->decimal('sub_total')
            ->allowEmptyString('sub_total');

        $validator
            ->decimal('total_amount')
            ->allowEmptyString('total_amount');

        $validator
            ->decimal('rate')
            ->requirePresence('rate', 'create')
            ->notEmptyString('rate');

        $validator
            ->scalar('currency')
            ->maxLength('currency', 10)
            ->allowEmptyString('currency');

        $validator
            ->integer('delivery_time_days')
            ->allowEmptyString('delivery_time_days');

        $validator
            ->date('validity_date')
            ->allowEmptyDate('validity_date');

        $validator
            ->scalar('remark')
            ->allowEmptyString('remark');

        $validator
            ->dateTime('submitted_at')
            ->allowEmptyDateTime('submitted_at');

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
        $rules->add($rules->existsIn(['rfq_quote_id'], 'RfqQuotes'), ['errorField' => 'rfq_quote_id']);

        return $rules;
    }
}
