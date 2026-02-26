<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RfqQuotes Model
 *
 * @property \App\Model\Table\RfqFootersTable&\Cake\ORM\Association\BelongsTo $RfqFooters
 * @property \App\Model\Table\RfqQuoteRevisionsTable&\Cake\ORM\Association\HasMany $RfqQuoteRevisions
 *
 * @method \App\Model\Entity\RfqQuote newEmptyEntity()
 * @method \App\Model\Entity\RfqQuote newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\RfqQuote> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RfqQuote get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\RfqQuote findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\RfqQuote patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\RfqQuote> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\RfqQuote|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\RfqQuote saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\RfqQuote>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RfqQuote>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RfqQuote>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RfqQuote> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RfqQuote>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RfqQuote>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\RfqQuote>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\RfqQuote> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RfqQuotesTable extends Table
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

        $this->setTable('rfq_quotes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('RfqFooters', [
            'foreignKey' => 'rfq_footer_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('RfqQuoteRevisions', [
            'foreignKey' => 'rfq_quote_id',
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
            ->integer('vendor_user_id')
            ->requirePresence('vendor_user_id', 'create')
            ->notEmptyString('vendor_user_id');

        $validator
            ->integer('latest_revision')
            ->allowEmptyString('latest_revision');

        $validator
            ->integer('max_revisions')
            ->allowEmptyString('max_revisions');

        $validator
            ->scalar('quote_status')
            ->maxLength('quote_status', 50)
            ->allowEmptyString('quote_status');

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
