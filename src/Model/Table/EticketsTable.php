<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use SoftDelete\Model\Table\SoftDeleteTrait;

/**
 * Etickets Model
 *
 * @method \App\Model\Entity\Eticket get($primaryKey, $options = [])
 * @method \App\Model\Entity\Eticket newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Eticket[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Eticket|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Eticket saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Eticket patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Eticket[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Eticket findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EticketsTable extends Table
{
    use SoftDeleteTrait;
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('etickets');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('qr')
            ->maxLength('qr', 255)
            ->requirePresence('qr', 'create')
            ->allowEmptyString('qr', false);

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->allowEmptyString('name', false);

        $validator
            ->scalar('surname')
            ->maxLength('surname', 255)
            ->requirePresence('surname', 'create')
            ->allowEmptyString('surname', false);

        $validator
            ->scalar('cellphone')
            ->maxLength('cellphone', 255)
            ->requirePresence('cellphone', 'create')
            ->allowEmptyString('cellphone', false);

        $validator
            ->boolean('confirmation')
            ->allowEmptyString('confirmation', false);

        $validator
            ->boolean('scanned')
            ->allowEmptyString('scanned', false);

        $validator
            ->scalar('type')
            ->requirePresence('type', 'create')
            ->allowEmptyString('type', false);

        $validator
            ->requirePresence('mesa', 'create')
            ->allowEmptyString('mesa', false);

        $validator
            ->dateTime('deleted')
            ->allowEmptyDateTime('deleted');

        return $validator;
    }
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['qr']));
        return $rules;
    }
}
