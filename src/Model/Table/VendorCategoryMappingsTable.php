<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * VendorCategoryMappings Model
 *
 * @property \App\Model\Table\VendorsTable&\Cake\ORM\Association\BelongsTo $Vendors
 * @property \App\Model\Table\CategoriesTable&\Cake\ORM\Association\BelongsTo $Categories
 *
 * @method \App\Model\Entity\VendorCategoryMapping newEmptyEntity()
 * @method \App\Model\Entity\VendorCategoryMapping newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\VendorCategoryMapping> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\VendorCategoryMapping get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\VendorCategoryMapping findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\VendorCategoryMapping patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\VendorCategoryMapping> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\VendorCategoryMapping|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\VendorCategoryMapping saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\VendorCategoryMapping>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\VendorCategoryMapping>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\VendorCategoryMapping>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\VendorCategoryMapping> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\VendorCategoryMapping>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\VendorCategoryMapping>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\VendorCategoryMapping>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\VendorCategoryMapping> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class VendorCategoryMappingsTable extends Table
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

        $this->setTable('vendor_category_mappings');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Vendors', [
            'foreignKey' => 'vendor_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Categories', [
            'foreignKey' => 'category_id',
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
            ->integer('vendor_id')
            ->notEmptyString('vendor_id');

        $validator
            ->integer('category_id')
            ->notEmptyString('category_id');

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
        $rules->add($rules->existsIn(['vendor_id'], 'Vendors'), ['errorField' => 'vendor_id']);
        $rules->add($rules->existsIn(['category_id'], 'Categories'), ['errorField' => 'category_id']);

        return $rules;
    }
}
