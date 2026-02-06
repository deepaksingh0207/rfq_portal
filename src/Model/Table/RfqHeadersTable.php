<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RfqHeaders Model
 *
 * @property \App\Model\Table\PrHeadersTable&\Cake\ORM\Association\BelongsTo $PrHeaders
 * @property \App\Model\Table\PoHeadersTable&\Cake\ORM\Association\HasMany $PoHeaders
 * @property \App\Model\Table\RfqFootersTable&\Cake\ORM\Association\HasMany $RfqFooters
 * @property \App\Model\Table\RfqSuppliersTable&\Cake\ORM\Association\HasMany $RfqSuppliers
 *
 * @method \App\Model\Entity\RfqHeader newEmptyEntity()
 * @method \App\Model\Entity\RfqHeader newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\RfqHeader> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RfqHeader get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\RfqHeader findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\RfqHeader patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\RfqHeader> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\RfqHeader|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\RfqHeader saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\RfqHeader>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RfqHeader>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RfqHeader>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RfqHeader> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RfqHeader>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RfqHeader>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RfqHeader>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RfqHeader> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RfqHeadersTable extends Table
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

        $this->setTable('rfq_headers');
        $this->setDisplayField('rfq_number');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('PrHeaders', [
            'foreignKey' => 'pr_header_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('PoHeaders', [
            'foreignKey' => 'rfq_header_id',
        ]);
        $this->hasMany('RfqFooters', [
            'foreignKey' => 'rfq_header_id',
        ]);
        $this->hasMany('RfqSuppliers', [
            'foreignKey' => 'rfq_header_id',
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
            ->scalar('rfq_number')
            ->maxLength('rfq_number', 50)
            ->requirePresence('rfq_number', 'create')
            ->notEmptyString('rfq_number')
            ->add('rfq_number', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('rfq_type')
            ->maxLength('rfq_type', 50)
            ->requirePresence('rfq_type', 'create')
            ->notEmptyString('rfq_type');

        $validator
            ->notEmptyString('pr_header_id');

        $validator
            ->date('rfq_date')
            ->requirePresence('rfq_date', 'create')
            ->notEmptyDate('rfq_date');

        $validator
            ->dateTime('bidding_start_at')
            ->requirePresence('bidding_start_at', 'create')
            ->notEmptyDateTime('bidding_start_at');

        $validator
            ->dateTime('bidding_end_at')
            ->requirePresence('bidding_end_at', 'create')
            ->notEmptyDateTime('bidding_end_at');

        $validator
            ->scalar('status')
            ->maxLength('status', 50)
            ->requirePresence('status', 'create')
            ->notEmptyString('status');

        $validator
            ->scalar('created_by')
            ->maxLength('created_by', 100)
            ->requirePresence('created_by', 'create')
            ->notEmptyString('created_by');

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
        $rules->add($rules->isUnique(['rfq_number']), ['errorField' => 'rfq_number']);
        $rules->add($rules->existsIn(['pr_header_id'], 'PrHeaders'), ['errorField' => 'pr_header_id']);

        return $rules;
    }
}
