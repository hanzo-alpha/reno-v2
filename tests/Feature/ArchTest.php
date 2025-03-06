<?php

declare(strict_types=1);

arch('No debugging statements are left in our code.')
    ->expect(['dd', 'dump', 'ray'])
    ->not->toBeUsed();
