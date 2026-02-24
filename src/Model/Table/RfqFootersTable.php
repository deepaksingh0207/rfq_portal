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
 * @property \App\Model\Table\CategoriesTable&\Cake\ORM\Association\BelongsTo $Categories
 * @property \App\Model\Table\RfqFooterVendorsTable&\Cake\ORM\Association\HasMany $RfqFooterVendors
 * @property \App\Model\Table\RfqManualMaterialsTable&\Cake\ORM\Association\HasMany $RfqManualMaterials
 * @property \App\Model\Table\RfqPrMappingsTable&\Cake\ORM\Association\HasMany $RfqPrMappings
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
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('RfqHeaders', [
            'foreignKey' => 'rfq_header_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Categories', [
            'foreignKey' => 'category_id',
        ]);
        $this->hasMany('RfqFooterVendors', [
            'foreignKey' => 'rfq_footer_id',
        ]);
        $this->hasMany('RfqManualMaterials', [
            'foreignKey' => 'rfq_footer_id',
        ]);
        $this->hasMany('RfqPrMappings', [
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
            ->integer('rfq_header_id')
            ->notEmptyString('rfq_header_id');

        $validator
            ->scalar('item_no')
            ->maxLength('item_no', 10)
            ->allowEmptyString('item_no');

        $validator
            ->scalar('material_code')
            ->maxLength('material_code', 50)
            ->allowEmptyString('material_code');

        $validator
            ->scalar('model')
            ->maxLength('model', 100)
            ->allowEmptyString('model');

        $validator
            ->scalar('part_name')
            ->maxLength('part_name', 255)
            ->allowEmptyString('part_name');

        $validator
            ->scalar('make')
            ->maxLength('make', 100)
            ->allowEmptyString('make');

        $validator
            ->scalar('material_description')
            ->allowEmptyString('material_description');

        $validator
            ->scalar('material_group')
            ->maxLength('material_group', 50)
            ->allowEmptyString('material_group');

        $validator
            ->integer('category_id')
            ->allowEmptyString('category_id');

        $validator
            ->decimal('quantity')
            ->allowEmptyString('quantity');

        $validator
            ->scalar('uom')
            ->maxLength('uom', 10)
            ->allowEmptyString('uom');

        $validator
            ->date('delivery_date')
            ->allowEmptyDate('delivery_date');

        $validator
            ->scalar('specification')
            ->allowEmptyString('specification');

        $validator
            ->scalar('specification_attachment')
            ->allowEmptyFile('specification_attachment');

        $validator
            ->scalar('remark')
            ->allowEmptyString('remark');

        $validator
            ->scalar('plant')
            ->maxLength('plant', 10)
            ->allowEmptyString('plant');

        $validator
            ->scalar('source_type')
            ->maxLength('source_type', 50)
            ->allowEmptyString('source_type');

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
        $rules->add($rules->existsIn(['category_id'], 'Categories'), ['errorField' => 'category_id']);

        return $rules;
    }
}
