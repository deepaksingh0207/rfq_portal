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
            ->scalar('buyer_code')
            ->maxLength('buyer_code', 10)
            ->requirePresence('buyer_code', 'create')
            ->notEmptyString('buyer_code');

        $validator
            ->scalar('first_name')
            ->maxLength('first_name', 50)
            ->requirePresence('first_name', 'create')
            ->notEmptyString('first_name');

        $validator
            ->scalar('last_name')
            ->maxLength('last_name', 50)
            ->requirePresence('last_name', 'create')
            ->notEmptyString('last_name');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email');

        $validator
            ->boolean('is_active')
            ->notEmptyString('is_active');

        $validator
            ->boolean('is_deleted')
            ->notEmptyString('is_deleted');

        $validator
            ->dateTime('created_on')
            ->notEmptyDateTime('created_on');

        $validator
            ->dateTime('updated_on')
            ->notEmptyDateTime('updated_on');

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
        $rules->add($rules->isUnique(['buyer_code', 'email']), ['errorField' => 'buyer_code', 'message' => __('This combination of buyer_code and email already exists')]);

        return $rules;
    }
}
