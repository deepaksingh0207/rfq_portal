<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SapPaymentTerms Model
 *
 * @method \App\Model\Entity\SapPaymentTerm newEmptyEntity()
 * @method \App\Model\Entity\SapPaymentTerm newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\SapPaymentTerm> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SapPaymentTerm get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\SapPaymentTerm findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\SapPaymentTerm patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\SapPaymentTerm> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\SapPaymentTerm|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\SapPaymentTerm saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\SapPaymentTerm>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\SapPaymentTerm>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\SapPaymentTerm>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\SapPaymentTerm> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\SapPaymentTerm>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\SapPaymentTerm>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\SapPaymentTerm>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\SapPaymentTerm> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SapPaymentTermsTable extends Table
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

        $this->setTable('sap_payment_terms');
        $this->setDisplayField('code');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->scalar('code')
            ->maxLength('code', 15)
            ->requirePresence('code', 'create')
            ->notEmptyString('code');

        $validator
            ->scalar('description')
            ->maxLength('description', 255)
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        $validator
            ->notEmptyString('is_active');

        return $validator;
    }
}
