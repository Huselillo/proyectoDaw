<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Temas;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class TemasController extends AbstractController
{
    /**
     * @Route("/temas", name="temas")
     */
    public function temas(){

        return $this->render('temarios.html.twig');
    }
    /**
     * @Route("/temas/{permiso}", name="permiso")
     */
    public function temasTipo($permiso){
        
        $permisoTema = $this->getDoctrine()->getRepository(Temas::class)->buscarPorPermiso($permiso);

        return $this->render('permisoTema.html.twig', array('permisoTema' =>$permisoTema));
    }

}
?>
