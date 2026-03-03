<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RfqSelectedQuotes Model
 *
 * @property \App\Model\Table\RfqFootersTable&\Cake\ORM\Association\BelongsTo $RfqFooters
 * @property \App\Model\Table\RfqQuoteRevisionsTable&\Cake\ORM\Association\BelongsTo $RfqQuoteRevisions
 * @property \App\Model\Table\RfqApprovalsTable&\Cake\ORM\Association\HasMany $RfqApprovals
 *
 * @method \App\Model\Entity\RfqSelectedQuote newEmptyEntity()
 * @method \App\Model\Entity\RfqSelectedQuote newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\RfqSelectedQuote> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RfqSelectedQuote get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\RfqSelectedQuote findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\RfqSelectedQuote patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\RfqSelectedQuote> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\RfqSelectedQuote|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\RfqSelectedQuote saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\RfqSelectedQuote>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RfqSelectedQuote>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RfqSelectedQuote>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RfqSelectedQuote> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RfqSelectedQuote>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RfqSelectedQuote>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RfqSelectedQuote>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RfqSelectedQuote> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RfqSelectedQuotesTable extends Table
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

        $this->setTable('rfq_selected_quotes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('RfqFooters', [
            'foreignKey' => 'rfq_footer_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('RfqQuoteRevisions', [
            'foreignKey' => 'rfq_quote_revision_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('RfqApprovals', [
            'foreignKey' => 'rfq_selected_quote_id',
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
            ->integer('rfq_quote_revision_id')
            ->notEmptyString('rfq_quote_revision_id');

        $validator
            ->integer('selected_by')
            ->requirePresence('selected_by', 'create')
            ->notEmptyString('selected_by');

        $validator
            ->dateTime('selected_at')
            ->allowEmptyDateTime('selected_at');

        $validator
            ->scalar('approval_status')
            ->maxLength('approval_status', 50)
            ->allowEmptyString('approval_status');

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
        $rules->add($rules->existsIn(['rfq_quote_revision_id'], 'RfqQuoteRevisions'), ['errorField' => 'rfq_quote_revision_id']);

        return $rules;
    }
}
