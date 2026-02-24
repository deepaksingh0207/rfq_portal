<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Approvers Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Approver newEmptyEntity()
 * @method \App\Model\Entity\Approver newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Approver> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Approver get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Approver findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Approver patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Approver> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Approver|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Approver saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Approver>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Approver>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Approver>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Approver> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Approver>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Approver>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Approver>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Approver> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ApproversTable extends Table
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

        $this->setTable('approvers');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
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
            ->integer('user_id')
            ->notEmptyString('user_id')
            ->add('user_id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('sap_code')
            ->maxLength('sap_code', 50)
            ->allowEmptyString('sap_code')
            ->add('sap_code', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('approver_name')
            ->maxLength('approver_name', 255)
            ->allowEmptyString('approver_name');

        $validator
            ->scalar('approver_email')
            ->maxLength('approver_email', 255)
            ->allowEmptyString('approver_email');

        $validator
            ->scalar('department')
            ->maxLength('department', 100)
            ->allowEmptyString('department');

        $validator
            ->scalar('position')
            ->maxLength('position', 100)
            ->allowEmptyString('position');

        $validator
            ->decimal('approval_limit')
            ->allowEmptyString('approval_limit');

        $validator
            ->boolean('can_approve_above_limit')
            ->allowEmptyString('can_approve_above_limit');

        $validator
            ->boolean('requires_second_approval')
            ->allowEmptyString('requires_second_approval');

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
        $rules->add($rules->isUnique(['sap_code'], ['allowMultipleNulls' => true]), ['errorField' => 'sap_code']);
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}
