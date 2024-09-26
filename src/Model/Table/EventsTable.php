<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class EventsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('events');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->dateTime('start')
            ->requirePresence('start', 'create')
            ->notEmptyDateTime('start');

        $validator
            ->dateTime('end')
            ->requirePresence('end', 'create')
            ->notEmptyDateTime('end');

        $validator
            ->boolean('all_day')
            ->requirePresence('all_day', 'create')
            ->notEmptyDateTime('all_day');

        return $validator;
    }
}
