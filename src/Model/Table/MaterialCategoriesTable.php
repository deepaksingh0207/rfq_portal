<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MaterialCategories Model
 *
 * @property \App\Model\Table\MaterialsTable&\Cake\ORM\Association\HasMany $Materials
 *
 * @method \App\Model\Entity\MaterialCategory newEmptyEntity()
 * @method \App\Model\Entity\MaterialCategory newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\MaterialCategory> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MaterialCategory get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\MaterialCategory findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\MaterialCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\MaterialCategory> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\MaterialCategory|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\MaterialCategory saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\MaterialCategory>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MaterialCategory>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MaterialCategory>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MaterialCategory> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MaterialCategory>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MaterialCategory>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\MaterialCategory>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\MaterialCategory> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MaterialCategoriesTable extends Table
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

        $this->setTable('material_categories');
        $this->setDisplayField('category_code');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Materials', [
            'foreignKey' => 'material_category_id',
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
            ->scalar('category_code')
            ->maxLength('category_code', 20)
            ->requirePresence('category_code', 'create')
            ->notEmptyString('category_code')
            ->add('category_code', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('category_name')
            ->maxLength('category_name', 100)
            ->requirePresence('category_name', 'create')
            ->notEmptyString('category_name');

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
        $rules->add($rules->isUnique(['category_code']), ['errorField' => 'category_code']);

        return $rules;
    }
}
