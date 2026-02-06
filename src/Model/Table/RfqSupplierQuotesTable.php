<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RfqSupplierQuotes Model
 *
 * @property \App\Model\Table\RfqFootersTable&\Cake\ORM\Association\BelongsTo $RfqFooters
 * @property \App\Model\Table\SuppliersTable&\Cake\ORM\Association\BelongsTo $Suppliers
 *
 * @method \App\Model\Entity\RfqSupplierQuote newEmptyEntity()
 * @method \App\Model\Entity\RfqSupplierQuote newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\RfqSupplierQuote> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RfqSupplierQuote get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\RfqSupplierQuote findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\RfqSupplierQuote patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\RfqSupplierQuote> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\RfqSupplierQuote|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\RfqSupplierQuote saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\RfqSupplierQuote>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RfqSupplierQuote>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RfqSupplierQuote>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RfqSupplierQuote> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RfqSupplierQuote>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RfqSupplierQuote>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RfqSupplierQuote>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RfqSupplierQuote> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RfqSupplierQuotesTable extends Table
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

        $this->setTable('rfq_supplier_quotes');
        $this->setDisplayField('currency');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('RfqFooters', [
            'foreignKey' => 'rfq_footer_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Suppliers', [
            'foreignKey' => 'supplier_id',
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
            ->notEmptyString('rfq_footer_id');

        $validator
            ->notEmptyString('supplier_id');

        $validator
            ->decimal('quoted_price')
            ->requirePresence('quoted_price', 'create')
            ->notEmptyString('quoted_price');

        $validator
            ->scalar('currency')
            ->maxLength('currency', 5)
            ->requirePresence('currency', 'create')
            ->notEmptyString('currency');

        $validator
            ->integer('delivery_days')
            ->requirePresence('delivery_days', 'create')
            ->notEmptyString('delivery_days');

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
        $rules->add($rules->existsIn(['rfq_footer_id'], 'RfqFooters'), ['errorField' => 'rfq_footer_id']);
        $rules->add($rules->existsIn(['supplier_id'], 'Suppliers'), ['errorField' => 'supplier_id']);

        return $rules;
    }
}
