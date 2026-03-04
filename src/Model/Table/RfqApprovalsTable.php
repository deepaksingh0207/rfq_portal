<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RfqApprovals Model
 *
 * @property \App\Model\Table\RfqSelectedQuotesTable&\Cake\ORM\Association\BelongsTo $RfqSelectedQuotes
 *
 * @method \App\Model\Entity\RfqApproval newEmptyEntity()
 * @method \App\Model\Entity\RfqApproval newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\RfqApproval> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RfqApproval get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\RfqApproval findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\RfqApproval patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\RfqApproval> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\RfqApproval|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\RfqApproval saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\RfqApproval>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RfqApproval>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RfqApproval>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RfqApproval> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RfqApproval>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RfqApproval>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RfqApproval>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RfqApproval> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RfqApprovalsTable extends Table
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

        $this->setTable('rfq_approvals');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('RfqSelectedQuotes', [
            'foreignKey' => 'rfq_selected_quote_id',
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
            ->integer('rfq_selected_quote_id')
            ->notEmptyString('rfq_selected_quote_id');

        $validator
            ->integer('level_no')
            ->requirePresence('level_no', 'create')
            ->notEmptyString('level_no');

        $validator
            ->integer('approver_user_id')
            ->requirePresence('approver_user_id', 'create')
            ->notEmptyString('approver_user_id');

        $validator
            ->scalar('status')
            ->maxLength('status', 50)
            ->allowEmptyString('status');

        $validator
            ->scalar('remark')
            ->allowEmptyString('remark');

        $validator
            ->dateTime('action_date')
            ->allowEmptyDateTime('action_date');

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
        $rules->add($rules->existsIn(['rfq_selected_quote_id'], 'RfqSelectedQuotes'), ['errorField' => 'rfq_selected_quote_id']);

        return $rules;
    }
}
