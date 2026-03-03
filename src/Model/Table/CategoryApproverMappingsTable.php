<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CategoryApproverMappings Model
 *
 * @property \App\Model\Table\CategoriesTable&\Cake\ORM\Association\BelongsTo $Categories
 *
 * @method \App\Model\Entity\CategoryApproverMapping newEmptyEntity()
 * @method \App\Model\Entity\CategoryApproverMapping newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\CategoryApproverMapping> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CategoryApproverMapping get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\CategoryApproverMapping findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\CategoryApproverMapping patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\CategoryApproverMapping> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\CategoryApproverMapping|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\CategoryApproverMapping saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\CategoryApproverMapping>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CategoryApproverMapping>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\CategoryApproverMapping>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CategoryApproverMapping> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\CategoryApproverMapping>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CategoryApproverMapping>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\CategoryApproverMapping>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\CategoryApproverMapping> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CategoryApproverMappingsTable extends Table
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

        $this->setTable('category_approver_mappings');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Categories', [
            'foreignKey' => 'category_id',
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
            ->integer('category_id')
            ->allowEmptyString('category_id');

        $validator
            ->integer('approver_user_id')
            ->allowEmptyString('approver_user_id');

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
        $rules->add($rules->existsIn(['category_id'], 'Categories'), ['errorField' => 'category_id']);

        return $rules;
    }
}
