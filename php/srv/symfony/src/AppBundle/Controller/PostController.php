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
/* use Symfony\Bundle\FrameworkBundle\Controller\Controller; */
use Sonata\NewsBundle\Controller\PostController as Controller;

class PostController extends Controller
{

    public function searchAction(Request $request, array $criteria = array(), array $parameters = array())
    {

        return $this->redirectToRoute('sonata_news_search_pretty', array(
                'query_string' => $request->get('query_string')
                ), 302);
    }

    /**
     * @param array $criteria
     * @param array $parameters
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function searchPrettyAction(Request $request, array $criteria = array(), array $parameters = array())
    {
        $page = $this->getRequest()->get('page', 1);

        $pager = $this->getPostManager()->getPager(
            $criteria, $page
        );

        $query2 = $pager->getQuery();

        $query_string = str_replace(['_', '-'], ' ', $request->get('query_string'));
        $search_array = explode(' ', $query_string);

        $repository = $this->getPostManager()->getObjectManager()->getRepository('AppBundle:News\Post');

        $first = ($page == 1) ? 0 : $page * 2;
        $qb = $repository->createQueryBuilder('p')
            ->setFirstResult($first)
            ->setMaxResults(2);
        ;

        /*
          $query = $qb->createQueryBuilder('p')
          ->where('p.rawContent LIKE :query_string')
          ->orWhere('p.title LIKE :query_string')
          ->where('p.title LIKE :query_string')
          ->setParameter('query_string', '%' . $query_string . '%')
          ->getQuery()
          ;
         */

        $search_fields = ['rawContent', 'title'];
        foreach ($search_array as $key => $value) {
            foreach ($search_fields as $field) {
                $qb->AndWhere('p.' . $field . ' LIKE :query_string_' . $key)
                    ->orWhere('p.' . $field . ' LIKE :query_string_' . $key)
                    ->setParameter('query_string_' . $key, '%' . $value . '%')
                ;
            }
        }
        $query = $qb->getQuery();

        /*
          $query = $this->getPostManager()->getObjectManager()
          ->createQuery("SELECT p FROM ApplicationSonataNewsBundle:Post p WHERE p.rawContent LIKE :query_string OR p.title LIKE :query_string")
          ->setParameter('query_string', '%' . $query_string . '%')
          ;
         */

        $pager->setQuery($query);

        $parameters = array_merge(array(
            'pager' => $pager,
            'blog' => $this->get('sonata.news.blog'),
            'tag' => false,
            'collection' => false,
            'route' => $this->getRequest()->get('_route'),
            'route_parameters' => $this->getRequest()->get('_route_params')
            ), $parameters);

        $response = $this->render(sprintf('SonataNewsBundle:Post:archive.%s.twig', $this->getRequest()->getRequestFormat()), $parameters);

        if ('rss' === $this->getRequest()->getRequestFormat()) {
            $response->headers->set('Content-Type', 'application/rss+xml');
        }

        return $response;
    }
}
