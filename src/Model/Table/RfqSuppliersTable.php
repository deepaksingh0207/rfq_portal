<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RfqSuppliers Model
 *
 * @property \App\Model\Table\RfqHeadersTable&\Cake\ORM\Association\BelongsTo $RfqHeaders
 * @property \App\Model\Table\SuppliersTable&\Cake\ORM\Association\BelongsTo $Suppliers
 *
 * @method \App\Model\Entity\RfqSupplier newEmptyEntity()
 * @method \App\Model\Entity\RfqSupplier newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\RfqSupplier> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RfqSupplier get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\RfqSupplier findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\RfqSupplier patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\RfqSupplier> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\RfqSupplier|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\RfqSupplier saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\RfqSupplier>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RfqSupplier>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RfqSupplier>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RfqSupplier> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RfqSupplier>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RfqSupplier>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RfqSupplier>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RfqSupplier> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RfqSuppliersTable extends Table
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

        $this->setTable('rfq_suppliers');
        $this->setDisplayField('response_status');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('RfqHeaders', [
            'foreignKey' => 'rfq_header_id',
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
            ->notEmptyString('rfq_header_id');

        $validator
            ->notEmptyString('supplier_id');

        $validator
            ->dateTime('invited_at')
            ->requirePresence('invited_at', 'create')
            ->notEmptyDateTime('invited_at');

        $validator
            ->dateTime('responded_at')
            ->requirePresence('responded_at', 'create')
            ->notEmptyDateTime('responded_at');

        $validator
            ->scalar('response_status')
            ->maxLength('response_status', 50)
            ->requirePresence('response_status', 'create')
            ->notEmptyString('response_status');

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
        $rules->add($rules->existsIn(['rfq_header_id'], 'RfqHeaders'), ['errorField' => 'rfq_header_id']);
        $rules->add($rules->existsIn(['supplier_id'], 'Suppliers'), ['errorField' => 'supplier_id']);

        return $rules;
    }
}
