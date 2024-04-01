<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class ChangeDefaultValueForSneakers extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('sneakers');
        $table->changeColumn('releasedate', 'date', [
            'default' => null,
            'null' => true,
        ]);
        $table->changeColumn('color', 'string', [
            'default' => null,
            'limit' => 20,
            'null' => true,
        ]);
        $table->update();
    }
}
