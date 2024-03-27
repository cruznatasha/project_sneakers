<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SneakersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SneakersTable Test Case
 */
class SneakersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SneakersTable
     */
    protected $Sneakers;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Sneakers',
        'app.Brands',
        'app.Favorites',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Sneakers') ? [] : ['className' => SneakersTable::class];
        $this->Sneakers = $this->getTableLocator()->get('Sneakers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Sneakers);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\SneakersTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\SneakersTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
