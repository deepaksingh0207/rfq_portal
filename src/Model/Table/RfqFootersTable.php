<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RfqFooters Model
 *
 * @property \App\Model\Table\RfqHeadersTable&\Cake\ORM\Association\BelongsTo $RfqHeaders
 * @property \App\Model\Table\PrFootersTable&\Cake\ORM\Association\BelongsTo $PrFooters
 * @property \App\Model\Table\MaterialsTable&\Cake\ORM\Association\BelongsTo $Materials
 * @property \App\Model\Table\PoFootersTable&\Cake\ORM\Association\HasMany $PoFooters
 * @property \App\Model\Table\RfqSupplierQuotesTable&\Cake\ORM\Association\HasMany $RfqSupplierQuotes
 *
 * @method \App\Model\Entity\RfqFooter newEmptyEntity()
 * @method \App\Model\Entity\RfqFooter newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\RfqFooter> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RfqFooter get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\RfqFooter findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\RfqFooter patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\RfqFooter> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\RfqFooter|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\RfqFooter saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\RfqFooter>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RfqFooter>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RfqFooter>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RfqFooter> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RfqFooter>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RfqFooter>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RfqFooter>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RfqFooter> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RfqFootersTable extends Table
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

        $this->setTable('rfq_footers');
        $this->setDisplayField('description');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('RfqHeaders', [
            'foreignKey' => 'rfq_header_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('PrFooters', [
            'foreignKey' => 'pr_footer_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Materials', [
            'foreignKey' => 'material_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('PoFooters', [
            'foreignKey' => 'rfq_footer_id',
        ]);
        $this->hasMany('RfqSupplierQuotes', [
            'foreignKey' => 'rfq_footer_id',
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
            ->notEmptyString('rfq_header_id');

        $validator
            ->notEmptyString('pr_footer_id');

        $validator
            ->notEmptyString('material_id');

        $validator
            ->scalar('description')
            ->maxLength('description', 255)
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        $validator
            ->decimal('quantity')
            ->requirePresence('quantity', 'create')
            ->notEmptyString('quantity');

        $validator
            ->scalar('uom')
            ->maxLength('uom', 10)
            ->requirePresence('uom', 'create')
            ->notEmptyString('uom');

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
        $rules->add($rules->existsIn(['rfq_header_id'], 'RfqHeaders'), ['errorField' => 'rfq_header_id']);
        $rules->add($rules->existsIn(['pr_footer_id'], 'PrFooters'), ['errorField' => 'pr_footer_id']);
        $rules->add($rules->existsIn(['material_id'], 'Materials'), ['errorField' => 'material_id']);

        return $rules;
    }
}
