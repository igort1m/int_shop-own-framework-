<?php

namespace Controller;

use Library\Controller;
use Library\Request;
//use Model\Form\ContactForm;
//use Model\Feedback;
use Library\Router;
use Library\Session;

class SiteController extends Controller
{
    public function indexAction(Request $request)
    {

        $repo = $this->container->get('repository_manager')->getRepository('Category');
        $cats = $repo->findAll('1');
        $args=['cats'=>$cats];
//        dump($args);die;
        return $this->render('index.phtml', $args);
    }
    

}