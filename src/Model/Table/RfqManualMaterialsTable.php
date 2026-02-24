<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RfqManualMaterials Model
 *
 * @property \App\Model\Table\RfqFootersTable&\Cake\ORM\Association\BelongsTo $RfqFooters
 *
 * @method \App\Model\Entity\RfqManualMaterial newEmptyEntity()
 * @method \App\Model\Entity\RfqManualMaterial newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\RfqManualMaterial> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RfqManualMaterial get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\RfqManualMaterial findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\RfqManualMaterial patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\RfqManualMaterial> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\RfqManualMaterial|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\RfqManualMaterial saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\RfqManualMaterial>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RfqManualMaterial>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RfqManualMaterial>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RfqManualMaterial> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RfqManualMaterial>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RfqManualMaterial>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RfqManualMaterial>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RfqManualMaterial> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RfqManualMaterialsTable extends Table
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

        $this->setTable('rfq_manual_materials');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('RfqFooters', [
            'foreignKey' => 'rfq_footer_id',
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
            ->integer('rfq_footer_id')
            ->notEmptyString('rfq_footer_id');

        $validator
            ->scalar('material_code')
            ->maxLength('material_code', 50)
            ->allowEmptyString('material_code');

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
        $rules->add($rules->existsIn(['rfq_footer_id'], 'RfqFooters'), ['errorField' => 'rfq_footer_id']);

        return $rules;
    }
}
