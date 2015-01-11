<?php
namespace Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;

use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Response;

use \PommProject\Foundation\Where;

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

    protected function getModelForCategory($category)
    {
        $session = $this->app['pomm']['bobinaudio'];
        switch($category)
        {
        case "alimentation":
            return $session
                ->getModel('\Model\Bobinaudio\TransfoSchema\PsuModel')
                ;
        case "self":
            return $session
                ->getModel('\Model\Bobinaudio\TransfoSchema\InductanceModel')
                ;
        case "push-pull":
            return $session
                ->getModel('\Model\Bobinaudio\TransfoSchema\OptPpModel')
                ;
        case "single-ended":
            return $session
                ->getModel('\Model\Bobinaudio\TransfoSchema\OptSeModel')
                ;
        }

        throw new \InvalidParameterException(sprintf("I do not know model class for category '%s'.", $category));
    }

    public function executeList($category)
    {
        try {
            $model = $this->getModelForCategory($category);
        } catch (\InvalidParameterException $e) {
            return $this->app->abort(sprintf("No such category '%s'.", $category), 404);
        }

        $transfo_pager = $model->paginateFindWithDimensionWhere(new Where('is_online'), 'order by is_on_top desc, display_order desc', 10, $this->app['request']->get('page', 1));

        return $this->app['twig']->render(sprintf("%s/category/%s.html.twig", $this->app['request']->get('_locale'), $category), [ 'transfo_pager' => $transfo_pager ]);
    }
}

