<?php
namespace Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;

use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Response;

class AjaxController implements ControllerProviderInterface
{
    protected $app;

    public function connect(Application $app)
    {
        $this->app = $app;
        $controller_collection = $app['controllers_factory'];
        $controller_collection->before([$this, 'before']);
        $controller_collection->get('/search/reference', array($this, 'executeSearchRef'))->bind('ajax_search_ref');

        return $controller_collection;
    }

    public function before(Request $request, Application $app)
    {
        if ($request->isXmlHttpRequest() === false)
        {
            return $app->abort(sprintf("Not an ajax request"), 404);
        }

        return $request;
    }

    public function executeSearchRef()
    {
        $results = $this->app['pomm.connection']->getMapFor('Model\Bobinaudio\Transfo')->findForRefSearch($this->app['request']->query->get('ref'));

        return array_to_json(["response" => $results->export() ]);
    }
}
