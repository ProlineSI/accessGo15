<?php
use Migrations\AbstractMigration;

class AddrestSacenedTable extends AbstractMigration
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
        $table = $this->table('etickets');
        $table->addColumn('scanCount', 'integer', [
            'default' => 0,
            'null' => false,
        ]);
        $table->update();
    }
}
