<?php
use Migrations\AbstractMigration;

class CreateAllTable extends AbstractMigration
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
         //TABLE USERS
         $table = $this->table('users');
         $table->addColumn('name', 'string', [
             'default' => null,
             'limit' => 255,
             'null' => false,
         ]);
         $table->addColumn('surname', 'string', [
             'default' => null,
             'limit' => 255,
             'null' => false,
         ]);
         $table->addColumn('cellphone', 'string', [
             'default' => null,
             'limit' => 255,
             'null' => false,
         ]);
         $table->addColumn('username', 'string', [
             'default' => null,
             'limit' => 255,
             'null' => false,
         ]);
         $table->addColumn('password', 'string', [
             'default' => null,
             'limit' => 255,
             'null' => false,
         ]);
         $table->addColumn('role', 'enum', [
            'values' => 'admin, scanner'
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

        //TABLE etickets
        $table = $this->table('etickets');
        $table->addColumn('qr', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('name', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('surname', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('cellphone', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('confirmation', 'boolean', [
            'default' => false,
            'null' => false,
        ]);
        $table->addColumn('scanned', 'boolean', [
            'default' => false,
            'null' => false,
        ]);
        $table->addColumn('type', 'enum', [
           'values' => 'cena, despuesDeCena'
        ]);
        $table->addColumn('mesa', 'integer', [
            'default' => null,
            'limit' => 255,
            'null' => false,
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
 
    }
}
