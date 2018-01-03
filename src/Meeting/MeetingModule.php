<?php
namespace App\Meeting;

use App\Meeting\Actions\MeetingAction;
use Framework\Module;
use Framework\Renderer\RendererInterface;
use Framework\Router;

class MeetingModule extends Module
{

    const DEFINITIONS = __DIR__ . '/config.php';

    const SEEDS =  __DIR__ . '/db/seeds';

    public function __construct(string $prefix, Router $router, RendererInterface $renderer)
    {
        $renderer->addPath('meeting', __DIR__ . '/views');
        $router->get($prefix, MeetingAction::class, 'meeting.index');
        $router->get($prefix . '/{slug:[A-Za-z\-0-9]+}-{id:[0-9]+}', MeetingAction::class, 'meeting.show');
    }
}
