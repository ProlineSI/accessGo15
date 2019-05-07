<?php
    namespace App\Model\Table;
    
    use Cake\ORM\Query;
    use Cake\ORM\Table;
    use Cake\Validation\Validator;
    use SoftDelete\Model\Table\SoftDeleteTrait;

/**
 * Photos Model
 *
 * @method \App\Model\Entity\Photo get($primaryKey, $options = [])
 * @method \App\Model\Entity\Photo newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Photo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Photo|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Photo|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Photo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Photo[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Photo findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */

 class PhotosTable extends Table
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
    
            $this->setTable('photos');
            $this->setDisplayField('id');
            $this->setPrimaryKey('id');
    
            $this->addBehavior('Josegonzalez/Upload.Upload', [
                'photo' => []
            ]);
    
            $this->addBehavior('Timestamp');

            $this->belongsToMany('Events', [
                'foreignKey' => 'photo_id',
                'targetForeignKey' => 'event_id',
                'joinTable' => 'events_photos'
            ]);
    
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
                ->allowEmpty('id', 'create');
    
            $validator
                ->scalar('regular')
                ->maxLength('regular', 255)
                ->requirePresence('regular', 'create')
                ->notEmpty('regular');
    
            $validator
                ->scalar('thumbnail')
                ->maxLength('thumbnail', 255)
                ->requirePresence('thumbnail', 'create')
                ->notEmpty('thumbnail');
    
            $validator
                ->dateTime('deleted')
                ->allowEmpty('deleted');
    
            return $validator;
        }


}