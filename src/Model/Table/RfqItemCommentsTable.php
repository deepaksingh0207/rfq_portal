<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RfqItemComments Model
 *
 * @property \App\Model\Table\RfqFootersTable&\Cake\ORM\Association\BelongsTo $RfqFooters
 *
 * @method \App\Model\Entity\RfqItemComment newEmptyEntity()
 * @method \App\Model\Entity\RfqItemComment newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\RfqItemComment> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RfqItemComment get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\RfqItemComment findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\RfqItemComment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\RfqItemComment> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\RfqItemComment|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\RfqItemComment saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\RfqItemComment>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RfqItemComment>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RfqItemComment>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RfqItemComment> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RfqItemComment>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RfqItemComment>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RfqItemComment>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RfqItemComment> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RfqItemCommentsTable extends Table
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

        $this->setTable('rfq_item_comments');
        $this->setDisplayField('sender_role');
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
            ->integer('buyer_user_id')
            ->allowEmptyString('buyer_user_id');

        $validator
            ->integer('vendor_user_id')
            ->allowEmptyString('vendor_user_id');

        $validator
            ->scalar('sender_role')
            ->maxLength('sender_role', 50)
            ->allowEmptyString('sender_role');

        $validator
            ->scalar('message')
            ->requirePresence('message', 'create')
            ->notEmptyString('message');

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
