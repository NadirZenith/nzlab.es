<?php

namespace AppBundle\Controller;

use Sonata\NewsBundle\Model\BlogInterface;
use Sonata\NewsBundle\Model\CommentInterface;
use Sonata\NewsBundle\Model\CommentManagerInterface;
use Sonata\NewsBundle\Model\PostInterface;
use Sonata\NewsBundle\Model\PostManagerInterface;
use Sonata\SeoBundle\Seo\SeoPageInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DevController extends Controller
{

    /**
     * @Route("/test", name="dev_test")
     */
    public function testAction(Request $request){

        dd($request);
    }

}
