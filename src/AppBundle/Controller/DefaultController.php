<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Debug\Exception\FlattenException;

class DefaultController extends Controller
{

    public function indexAction(Request $request)
    {
    	$template = $request->attributes->get('template');
    	$onglet = $request->attributes->get('onglet');
        $response = $this->render(sprintf('AppBundle:Default:%s.html.twig', $template), array('template' => $template, 'onglet' => $onglet));

		$response->setPublic();
		$response->setMaxAge(600);
		$response->setSharedMaxAge(600);
		//$response->headers->addCacheControlDirective('must-revalidate', true);

        return $response;
    }


	public function showExceptionAction(FlattenException $exception)
    {
		$response = new Response();

		$response->setStatusCode($exception->getStatusCode());
		$response->headers->set('Refresh', sprintf('0; url=%s', $this->generateUrl('app_index')));

		return $response;
    }

}
