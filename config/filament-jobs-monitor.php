<?php

declare(strict_types=1);

return [
    'resources' => [
        'enabled' => true,
        'label' => 'Pekerjaan',
        'plural_label' => 'Pekerjaan',
        'navigation_group' => 'Settings',
        'navigation_icon' => '',
        'navigation_sort' => null,
        'navigation_count_badge' => true,
        'resource' => Croustibat\FilamentJobsMonitor\Resources\QueueMonitorResource::class,
        'cluster' => null,
    ],
    'pruning' => [
        'enabled' => true,
        'retention_days' => 7,
    ],
    'queues' => [
        'default',
    ],
];
