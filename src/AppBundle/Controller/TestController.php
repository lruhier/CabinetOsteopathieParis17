<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Debug\Exception\FlattenException;

class TestController extends Controller
{

    public function indexAction(Request $request)
    {
    	$h2 = $request->attributes->get('h2');
        $max = 200;
        $response = $this->render('AppBundle:Test:test.html.twig', ['max' => $max]);
        if ($h2) for ($i = 1; $i <= $max; $i++) {
            header("Link: </images/{$i}.jpg>; rel=preload; as=image", false);
        }

        return $response;
    }

}
