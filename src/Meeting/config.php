<?php

use App\Meeting\MeetingModule;
use function \Di\object;
use function \Di\get;

return [
    'meeting.prefix' => '/meeting',
    MeetingModule::class => object()->constructorParameter('prefix', get('meeting.prefix'))
];
