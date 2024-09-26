<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EventsFixture
 */
class EventsFixture extends TestFixture
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
                'title' => 'Lorem ipsum dolor sit amet',
                'start' => '2024-09-25 12:58:33',
                'end' => '2024-09-25 12:58:33',
                'created' => '2024-09-25 12:58:33',
                'modified' => '2024-09-25 12:58:33',
            ],
        ];
        parent::init();
    }
}
