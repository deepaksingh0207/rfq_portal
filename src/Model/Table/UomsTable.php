<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Uoms Model
 *
 * @method \App\Model\Entity\Uom newEmptyEntity()
 * @method \App\Model\Entity\Uom newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Uom> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Uom get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Uom findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Uom patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Uom> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Uom|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Uom saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Uom>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Uom>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Uom>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Uom> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Uom>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Uom>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Uom>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Uom> deleteManyOrFail(iterable $entities, array $options = [])
 */
class UomsTable extends Table
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

        $this->setTable('uoms');
        $this->setDisplayField('code');
        $this->setPrimaryKey('id');
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
            ->maxLength('code', 3)
            ->requirePresence('code', 'create')
            ->notEmptyString('code');

        $validator
            ->scalar('description')
            ->maxLength('description', 40)
            ->requirePresence('description', 'create')
            ->notEmptyString('description');

        $validator
            ->notEmptyString('status');

        $validator
            ->dateTime('created_date')
            ->notEmptyDateTime('created_date');

        $validator
            ->dateTime('updated_date')
            ->notEmptyDateTime('updated_date');

        return $validator;
    }
}
