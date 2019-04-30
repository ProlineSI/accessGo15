<?php
use Migrations\AbstractMigration;

class EditEventsTable2 extends AbstractMigration
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
        $table = $this->table('events');
        $table->addColumn('cena_time', 'time', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('despCena_time', 'time', [
            'default' => null,
            'null' => true,
        ]);
        $table->update();
    }
}
