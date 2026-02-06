<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PoFooters Model
 *
 * @property \App\Model\Table\PoHeadersTable&\Cake\ORM\Association\BelongsTo $PoHeaders
 * @property \App\Model\Table\RfqFootersTable&\Cake\ORM\Association\BelongsTo $RfqFooters
 * @property \App\Model\Table\MaterialsTable&\Cake\ORM\Association\BelongsTo $Materials
 *
 * @method \App\Model\Entity\PoFooter newEmptyEntity()
 * @method \App\Model\Entity\PoFooter newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\PoFooter> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PoFooter get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\PoFooter findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\PoFooter patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\PoFooter> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\PoFooter|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\PoFooter saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\PoFooter>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PoFooter>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\PoFooter>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PoFooter> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\PoFooter>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PoFooter>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\PoFooter>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PoFooter> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PoFootersTable extends Table
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

        $this->setTable('po_footers');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('PoHeaders', [
            'foreignKey' => 'po_header_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('RfqFooters', [
            'foreignKey' => 'rfq_footer_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Materials', [
            'foreignKey' => 'material_id',
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
            ->notEmptyString('po_header_id');

        $validator
            ->notEmptyString('rfq_footer_id');

        $validator
            ->notEmptyString('material_id');

        $validator
            ->decimal('quantity')
            ->requirePresence('quantity', 'create')
            ->notEmptyString('quantity');

        $validator
            ->decimal('price')
            ->requirePresence('price', 'create')
            ->notEmptyString('price');

        $validator
            ->date('delivery_date')
            ->requirePresence('delivery_date', 'create')
            ->notEmptyDate('delivery_date');

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
        $rules->add($rules->existsIn(['po_header_id'], 'PoHeaders'), ['errorField' => 'po_header_id']);
        $rules->add($rules->existsIn(['rfq_footer_id'], 'RfqFooters'), ['errorField' => 'rfq_footer_id']);
        $rules->add($rules->existsIn(['material_id'], 'Materials'), ['errorField' => 'material_id']);

        return $rules;
    }
}
