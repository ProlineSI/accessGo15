<?php
use Migrations\AbstractMigration;

class CreateEventsTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        //TABLE Events
        $table = $this->table('events');
        $table->addColumn('name', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('startTime', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('endTime', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('deleted', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => true,
        ]);
        $table->create();
        $refTable = $this->table('events');
        $refTable-> addColumn('user_id', 'integer', array('signed'=>'disable'))
        ->addForeignKey('user_id', 'users', 'id', array('delete' => 'CASCADE', 'update' => 'NO_ACTION'))
        ->update();

        //Foreing Key Eticket to events
        $refTable = $this->table('etickets');
        $refTable-> addColumn('event_id', 'integer', array('null' => true))
        ->addForeignKey('event_id', 'events', 'id', array('delete' => 'CASCADE', 'update' => 'NO_ACTION'));
        $refTable->update();
    }
}
