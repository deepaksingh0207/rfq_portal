<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Materials Model
 *
 * @property \App\Model\Table\MaterialCategoriesTable&\Cake\ORM\Association\BelongsTo $MaterialCategories
 * @property \App\Model\Table\PoFootersTable&\Cake\ORM\Association\HasMany $PoFooters
 * @property \App\Model\Table\PrFootersTable&\Cake\ORM\Association\HasMany $PrFooters
 * @property \App\Model\Table\RfqFootersTable&\Cake\ORM\Association\HasMany $RfqFooters
 *
 * @method \App\Model\Entity\Material newEmptyEntity()
 * @method \App\Model\Entity\Material newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Material> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Material get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Material findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Material patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Material> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Material|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Material saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Material>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Material>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Material>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Material> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Material>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Material>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Material>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Material> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MaterialsTable extends Table
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

        $this->setTable('materials');
        $this->setDisplayField('material_code');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('MaterialCategories', [
            'foreignKey' => 'material_category_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('PoFooters', [
            'foreignKey' => 'material_id',
        ]);
        $this->hasMany('PrFooters', [
            'foreignKey' => 'material_id',
        ]);
        $this->hasMany('RfqFooters', [
            'foreignKey' => 'material_id',
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
            ->scalar('material_code')
            ->maxLength('material_code', 50)
            ->requirePresence('material_code', 'create')
            ->notEmptyString('material_code')
            ->add('material_code', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('material_name')
            ->maxLength('material_name', 255)
            ->requirePresence('material_name', 'create')
            ->notEmptyString('material_name');

        $validator
            ->notEmptyString('material_category_id');

        $validator
            ->scalar('uom')
            ->maxLength('uom', 10)
            ->allowEmptyString('uom');

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
        $rules->add($rules->isUnique(['material_code']), ['errorField' => 'material_code']);
        $rules->add($rules->existsIn(['material_category_id'], 'MaterialCategories'), ['errorField' => 'material_category_id']);

        return $rules;
    }
}
