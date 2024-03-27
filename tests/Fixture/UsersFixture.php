<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 */
class UsersFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'created' => '2024-03-27 11:36:39',
                'modified' => '2024-03-27 11:36:39',
                'pseudo' => 'Lorem ipsum dolor ',
                'password' => 'Lorem ipsum dolor sit amet',
                'level' => 'Lorem ipsum dolor ',
            ],
        ];
        parent::init();
    }
}
