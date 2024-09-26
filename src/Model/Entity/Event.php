<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Event extends Entity
{
    protected array $_accessible = [
        'title' => true,
        'start' => true,
        'end' => true,
        'all_day' => true,
        'created' => true,
        'modified' => true,
    ];
}
