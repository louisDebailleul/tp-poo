<?php
namespace App\Meeting\Actions;

use App\Meeting\Table\MeetingTable;
use Framework\Actions\RouterAwareAction;
use Framework\Renderer\RendererInterface;
use Framework\Router;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;

class MeetingAction
{

    /**
     * @var RendererInterface
     */
    private $renderer;

    /**
     * @var Router
     */
    private $router;
    /**
     * @var MeetingTable
     */
    private $MeetingTable;

    use RouterAwareAction;

    public function __construct(RendererInterface $renderer, Router $router, MeetingTable $MeetingTable)
    {
        $this->renderer = $renderer;
        $this->router = $router;
        $this->MeetingTable = $MeetingTable;
    }

    public function __invoke(Request $request)
    {
        if ($request->getAttribute('id')) {
            return $this->show($request);
        }
        return $this->index();
    }

    public function index(): string
    {
        $meetings = $this->MeetingTable->findPaginated();
        return $this->renderer->render('@meeting/index', compact('meetings'));
    }

    /**
     * Affiche un article
     *
     * @param Request $request
     * @return ResponseInterface|string
     */
    public function show(Request $request)
    {
        $slug = $request->getAttribute('slug');
        $meeting = $this->MeetingTable->find($request->getAttribute('id'));
        $participent = $this->MeetingTable->findParticipenr($request->getAttribute('id'));
        if ($meeting->slug !== $slug) {

            return $this->redirect('meeting.show', [
                'slug' => $meeting->slug,
                'id' => $meeting->id_meeting
            ]);
        }

        return $this->renderer->render('@meeting/show', [
            'meeting' => $meeting,
            'participents' => $participent
        ]);
    }
}
