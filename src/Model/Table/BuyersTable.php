<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Buyers Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Buyer newEmptyEntity()
 * @method \App\Model\Entity\Buyer newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Buyer> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Buyer get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Buyer findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Buyer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Buyer> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Buyer|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Buyer saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Buyer>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Buyer>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Buyer>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Buyer> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Buyer>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Buyer>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Buyer>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Buyer> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BuyersTable extends Table
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

        $this->setTable('buyers');
        $this->setDisplayField('buyer_code');
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
            ->scalar('buyer_name')
            ->maxLength('buyer_name', 500)
            ->allowEmptyString('buyer_name');

        $validator
            ->scalar('buyer_email')
            ->maxLength('buyer_email', 150)
            ->allowEmptyString('buyer_email');

        $validator
            ->scalar('department')
            ->maxLength('department', 100)
            ->allowEmptyString('department');

        $validator
            ->scalar('cost_center')
            ->maxLength('cost_center', 50)
            ->allowEmptyString('cost_center');

        $validator
            ->scalar('purchasing_group')
            ->maxLength('purchasing_group', 50)
            ->allowEmptyString('purchasing_group');

        $validator
            ->scalar('phone')
            ->maxLength('phone', 20)
            ->allowEmptyString('phone');

        $validator
            ->scalar('mobile')
            ->maxLength('mobile', 20)
            ->allowEmptyString('mobile');

        $validator
            ->scalar('signature_path')
            ->maxLength('signature_path', 255)
            ->allowEmptyString('signature_path');

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
