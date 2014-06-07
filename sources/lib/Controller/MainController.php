<?php
namespace Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;

use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Response;

class MainController implements ControllerProviderInterface
{
    protected $app;

    public function connect(Application $app)
    {
        $this->app = $app;
        $controller_collection = $app['controllers_factory'];
        $controller_collection->get('/', array($this, 'executeIndex'))->bind('main_index');
        $controller_collection->get('/navbar', array($this, 'executeNavbar'))->bind('main_navbar');
        $controller_collection->get('/transformateurs/{category}', array($this, 'executeList'))->bind('main_list');

        return $controller_collection;
    }

    public function executeIndex()
    {
        return $this->app["twig"]->render(sprintf("%s/index.html.twig", $this->app['request']->get('_locale')));
    }

    public function executeNavbar()
    {
        return $this->app["twig"]->render(sprintf("%s/navbar.html.twig", $this->app['request']->get('_locale')), [ 'route' => $this->app['request']->get('route', 'main_index') ] );
    }

    protected function getMapForCategory($category)
    {
        switch($category)
        {
        case "alimentation":
            return $this->app['pomm.connection']
                ->getMapFor('\Model\Bobinaudio\Transfo\Psu')
                ;
        case "self":
            return $this->app['pomm.connection']
                ->getMapFor('\Model\Bobinaudio\Transfo\Self')
                ;
        case "push-pull":
            return $this->app['pomm.connection']
                ->getMapFor('\Model\Bobinaudio\Transfo\OptPp')
                ;
        case "single-ended":
            return $this->app['pomm.connection']
                ->getMapFor('\Model\Bobinaudio\Transfo\OptSe')
                ;
        }

        throw new \InvalidParameterException(sprintf("I do not know map class for category '%s'.", $category));
    }

    public function executeList($category)
    {
        try
        {
            $map = $this->getMapForCategory($category);
        }
        catch (\InvalidParameterException $e)
        {
            return $this->app->abort(sprintf("No such category '%s'.", $category), 404);
        }

        $transformers = $map->paginateFindWhere('is_online', [], 'ORDER BY is_on_top DESC, display_order DESC', 15, $this->app['request']->get('page', 1));

        return $this->app['twig']->render(sprintf("category/%s.html.twig", $category), [ 'transformers' => $transformers ]);
    }
}

