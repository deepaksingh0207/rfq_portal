<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PoHeaders Model
 *
 * @property \App\Model\Table\RfqHeadersTable&\Cake\ORM\Association\BelongsTo $RfqHeaders
 * @property \App\Model\Table\SuppliersTable&\Cake\ORM\Association\BelongsTo $Suppliers
 * @property \App\Model\Table\PoFootersTable&\Cake\ORM\Association\HasMany $PoFooters
 *
 * @method \App\Model\Entity\PoHeader newEmptyEntity()
 * @method \App\Model\Entity\PoHeader newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\PoHeader> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PoHeader get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\PoHeader findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\PoHeader patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\PoHeader> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\PoHeader|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\PoHeader saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\PoHeader>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PoHeader>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\PoHeader>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PoHeader> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\PoHeader>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PoHeader>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\PoHeader>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\PoHeader> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PoHeadersTable extends Table
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

        $this->setTable('po_headers');
        $this->setDisplayField('po_number');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('RfqHeaders', [
            'foreignKey' => 'rfq_header_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Suppliers', [
            'foreignKey' => 'supplier_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('PoFooters', [
            'foreignKey' => 'po_header_id',
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
            ->scalar('po_number')
            ->maxLength('po_number', 25)
            ->requirePresence('po_number', 'create')
            ->notEmptyString('po_number')
            ->add('po_number', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->notEmptyString('rfq_header_id');

        $validator
            ->notEmptyString('supplier_id');

        $validator
            ->date('po_date')
            ->requirePresence('po_date', 'create')
            ->notEmptyDate('po_date');

        $validator
            ->scalar('status')
            ->maxLength('status', 50)
            ->requirePresence('status', 'create')
            ->notEmptyString('status');

        $validator
            ->decimal('total_value')
            ->requirePresence('total_value', 'create')
            ->notEmptyString('total_value');

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
        $rules->add($rules->isUnique(['po_number']), ['errorField' => 'po_number']);
        $rules->add($rules->existsIn(['rfq_header_id'], 'RfqHeaders'), ['errorField' => 'rfq_header_id']);
        $rules->add($rules->existsIn(['supplier_id'], 'Suppliers'), ['errorField' => 'supplier_id']);

        return $rules;
    }
}
