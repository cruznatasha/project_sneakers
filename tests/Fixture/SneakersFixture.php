<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SneakersFixture
 */
class SneakersFixture extends TestFixture
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
                'created' => '2024-03-27 11:41:18',
                'modified' => '2024-03-27 11:41:18',
                'name' => 'Lorem ipsum dolor sit amet',
                'color' => 'Lorem ipsum dolor ',
                'releasedate' => '2024-03-27',
                'brand_id' => 1,
            ],
        ];
        parent::init();
    }
}
