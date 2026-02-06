<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Plants Model
 *
 * @method \App\Model\Entity\Plant newEmptyEntity()
 * @method \App\Model\Entity\Plant newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Plant> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Plant get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Plant findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Plant patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Plant> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Plant|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Plant saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Plant>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Plant>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Plant>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Plant> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Plant>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Plant>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Plant>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Plant> deleteManyOrFail(iterable $entities, array $options = [])
 */
class PlantsTable extends Table
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

        $this->setTable('plants');
        $this->setDisplayField('plant_code');
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
            ->integer('company_id')
            ->requirePresence('company_id', 'create')
            ->notEmptyString('company_id');

        $validator
            ->scalar('plant_code')
            ->maxLength('plant_code', 4)
            ->requirePresence('plant_code', 'create')
            ->notEmptyString('plant_code')
            ->add('plant_code', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('plant_name')
            ->maxLength('plant_name', 30)
            ->requirePresence('plant_name', 'create')
            ->notEmptyString('plant_name');

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
        $rules->add($rules->isUnique(['plant_code']), ['errorField' => 'plant_code']);

        return $rules;
    }
}
