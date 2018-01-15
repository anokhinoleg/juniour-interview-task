<?php
/**
 * Created by PhpStorm.
 * User: olegyurievich
 * Date: 21.12.17
 * Time: 17:39
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Response;

class HomepageController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function homepageAction()
    {
        return $this->redirectToRoute('sonata_user_admin_security_login');
    }
}