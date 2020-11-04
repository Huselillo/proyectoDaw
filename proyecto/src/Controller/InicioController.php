<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use App\Entity\Usuarios;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class InicioController extends AbstractController
{
    /**
     * @Route("/inicio", name="inicio")
     */
    public function dashboard(){

        $usuario = $this->getDoctrine()->getRepository(Usuarios::class);
        $usuario = $this->getUser();

        return $this->render('inicio.html.twig',array('usuario' =>$usuario));
    }
    /**
     * @Route("/", name="dashboard")
     */
    public function inicio(){
        return $this->redirectToRoute('login');
    }
}
?>