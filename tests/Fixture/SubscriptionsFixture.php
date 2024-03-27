<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SubscriptionsFixture
 */
class SubscriptionsFixture extends TestFixture
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
                'created' => '2024-03-27 11:41:40',
                'modified' => '2024-03-27 11:41:40',
                'brand_id' => 1,
                'user_id' => 1,
            ],
        ];
        parent::init();
    }
}
