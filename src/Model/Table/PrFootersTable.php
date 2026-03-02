<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PrFooters Model
 *
 * @property \App\Model\Table\PrHeadersTable&\Cake\ORM\Association\BelongsTo $PrHeaders
 *
 * @method \App\Model\Entity\PrFooter newEmptyEntity()
 * @method \App\Model\Entity\PrFooter newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\PrFooter> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PrFooter get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\PrFooter findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\PrFooter patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\PrFooter> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\PrFooter|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\PrFooter saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\PrFooter>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PrFooter>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\PrFooter>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PrFooter> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\PrFooter>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PrFooter>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\PrFooter>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PrFooter> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PrFootersTable extends Table
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

        $this->setTable('pr_footers');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('PrHeaders', [
            'foreignKey' => 'pr_header_id',
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
            ->integer('pr_header_id')
            ->notEmptyString('pr_header_id');

        $validator
            ->scalar('item_number')
            ->maxLength('item_number', 10)
            ->allowEmptyString('item_number');

        $validator
            ->scalar('material_code')
            ->maxLength('material_code', 50)
            ->allowEmptyString('material_code');

        $validator
            ->scalar('material_description')
            ->allowEmptyString('material_description');

        $validator
            ->decimal('quantity')
            ->allowEmptyString('quantity');

        $validator
            ->scalar('uom')
            ->maxLength('uom', 10)
            ->allowEmptyString('uom');

        $validator
            ->date('delivery_date')
            ->allowEmptyDate('delivery_date');

        $validator
            ->scalar('plant')
            ->maxLength('plant', 10)
            ->allowEmptyString('plant');

        $validator
            ->scalar('storage_location')
            ->maxLength('storage_location', 10)
            ->allowEmptyString('storage_location');

        $validator
            ->scalar('material_group')
            ->maxLength('material_group', 20)
            ->allowEmptyString('material_group');

        $validator
            ->decimal('estimated_price')
            ->allowEmptyString('estimated_price');

        $validator
            ->scalar('currency')
            ->maxLength('currency', 10)
            ->allowEmptyString('currency');

        $validator
            ->scalar('account_assignment_category')
            ->maxLength('account_assignment_category', 5)
            ->allowEmptyString('account_assignment_category');

        $validator
            ->scalar('rfq_status')
            ->maxLength('rfq_status', 50)
            ->allowEmptyString('rfq_status');

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
        $rules->add($rules->existsIn(['pr_header_id'], 'PrHeaders'), ['errorField' => 'pr_header_id']);

        return $rules;
    }
}
