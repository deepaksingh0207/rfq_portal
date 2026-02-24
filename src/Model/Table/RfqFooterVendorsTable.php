<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RfqFooterVendors Model
 *
 * @property \App\Model\Table\RfqFootersTable&\Cake\ORM\Association\BelongsTo $RfqFooters
 *
 * @method \App\Model\Entity\RfqFooterVendor newEmptyEntity()
 * @method \App\Model\Entity\RfqFooterVendor newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\RfqFooterVendor> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RfqFooterVendor get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\RfqFooterVendor findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\RfqFooterVendor patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\RfqFooterVendor> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\RfqFooterVendor|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\RfqFooterVendor saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\RfqFooterVendor>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RfqFooterVendor>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RfqFooterVendor>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RfqFooterVendor> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RfqFooterVendor>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RfqFooterVendor>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RfqFooterVendor>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RfqFooterVendor> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RfqFooterVendorsTable extends Table
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

        $this->setTable('rfq_footer_vendors');
        $this->setDisplayField('id');
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
            ->integer('vendor_user_id')
            ->requirePresence('vendor_user_id', 'create')
            ->notEmptyString('vendor_user_id');

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
