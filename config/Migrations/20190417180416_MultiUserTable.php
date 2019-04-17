<?php
use Migrations\AbstractMigration;

class MultiUserTable extends AbstractMigration
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
        $refTable = $this->table('users');
        $refTable-> addColumn('admin', 'integer', array('null' => true));
        $refTable->update();
    }
}
