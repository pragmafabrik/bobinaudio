<?php
namespace Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;

use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Response;

class AdminController implements ControllerProviderInterface
{
    protected $app;

    public function connect(Application $app)
    {
        $this->app = $app;
        $controller_collection = $app['controllers_factory'];
        $controller_collection->get('/', array($this, 'executeIndex'))->bind('admin_index');
        $controller_collection->put('/transformer/{category}/{ref}', array($this, 'executeNew'))->bind('admin_transformer_new');

        return $controller_collection;
    }

    protected function init()
    {
        $this->app['locale'] = 'fr';
    }

    public function executeIndex()
    {
        $this->init();
        return $this->app["twig"]->render('admin/index.html.twig');
    }
}
