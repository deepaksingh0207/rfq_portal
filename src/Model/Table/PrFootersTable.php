<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PrFooters Model
 *
 * @property \App\Model\Table\PrHeadersTable&\Cake\ORM\Association\BelongsTo $PrHeaders
 * @property \App\Model\Table\MaterialsTable&\Cake\ORM\Association\BelongsTo $Materials
 * @property \App\Model\Table\RfqFootersTable&\Cake\ORM\Association\HasMany $RfqFooters
 *
 * @method \App\Model\Entity\PrFooter newEmptyEntity()
 * @method \App\Model\Entity\PrFooter newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\PrFooter> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PrFooter get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\PrFooter findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\PrFooter patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\PrFooter> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\PrFooter|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\PrFooter saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\PrFooter>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PrFooter>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\PrFooter>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PrFooter> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\PrFooter>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PrFooter>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\PrFooter>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PrFooter> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PrFootersTable extends Table
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

        $this->setTable('pr_footers');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('PrHeaders', [
            'foreignKey' => 'pr_header_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Materials', [
            'foreignKey' => 'material_id',
        ]);
        $this->hasMany('RfqFooters', [
            'foreignKey' => 'pr_footer_id',
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
            ->notEmptyString('pr_header_id');

        $validator
            ->integer('line_no')
            ->allowEmptyString('line_no');

        $validator
            ->allowEmptyString('material_id');

        $validator
            ->scalar('description')
            ->maxLength('description', 255)
            ->allowEmptyString('description');

        $validator
            ->decimal('quantity')
            ->allowEmptyString('quantity');

        $validator
            ->scalar('uom')
            ->maxLength('uom', 10)
            ->allowEmptyString('uom');

        $validator
            ->decimal('estimated_price')
            ->allowEmptyString('estimated_price');

        $validator
            ->date('required_date')
            ->allowEmptyDate('required_date');

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
        $rules->add($rules->existsIn(['pr_header_id'], 'PrHeaders'), ['errorField' => 'pr_header_id']);
        $rules->add($rules->existsIn(['material_id'], 'Materials'), ['errorField' => 'material_id']);

        return $rules;
    }
}
