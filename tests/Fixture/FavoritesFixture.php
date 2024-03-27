<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FavoritesFixture
 */
class FavoritesFixture extends TestFixture
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
                'created' => '2024-03-27 11:40:50',
                'modified' => '2024-03-27 11:40:50',
                'sneaker_id' => 1,
                'user_id' => 1,
            ],
        ];
        parent::init();
    }
}
