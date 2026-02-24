<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RfqPrMappings Model
 *
 * @property \App\Model\Table\RfqFootersTable&\Cake\ORM\Association\BelongsTo $RfqFooters
 *
 * @method \App\Model\Entity\RfqPrMapping newEmptyEntity()
 * @method \App\Model\Entity\RfqPrMapping newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\RfqPrMapping> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RfqPrMapping get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\RfqPrMapping findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\RfqPrMapping patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\RfqPrMapping> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\RfqPrMapping|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\RfqPrMapping saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\RfqPrMapping>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RfqPrMapping>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RfqPrMapping>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RfqPrMapping> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RfqPrMapping>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RfqPrMapping>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RfqPrMapping>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RfqPrMapping> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RfqPrMappingsTable extends Table
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

        $this->setTable('rfq_pr_mappings');
        $this->setDisplayField('pr_number');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('RfqFooters', [
            'foreignKey' => 'rfq_footer_id',
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
            ->integer('rfq_footer_id')
            ->notEmptyString('rfq_footer_id');

        $validator
            ->scalar('pr_number')
            ->maxLength('pr_number', 20)
            ->requirePresence('pr_number', 'create')
            ->notEmptyString('pr_number');

        $validator
            ->scalar('pr_item_number')
            ->maxLength('pr_item_number', 10)
            ->requirePresence('pr_item_number', 'create')
            ->notEmptyString('pr_item_number');

        $validator
            ->scalar('material_code')
            ->maxLength('material_code', 50)
            ->allowEmptyString('material_code');

        $validator
            ->decimal('mapped_quantity')
            ->allowEmptyString('mapped_quantity');

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

        return $rules;
    }
}
