<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
    	require_once __DIR__."/../../../config.php";

        return $this->render('default/index.html.twig', [
			'domain' => (PROD) ? PROD_DOMAIN: LOCAL_DOMAIN,
		]);
    }
}