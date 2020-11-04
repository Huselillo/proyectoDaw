<?php
namespace App\Controller;

use App\Entity\Preguntas;
use App\Repository\PreguntasRepository;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\HttpFoundation\JsonResponse;



class PreguntasController extends AbstractController
{
/**
* @Route("/nueva/pregunta", name="nuevaPregunta")
*/
public function nuevaPregunta(Request $request, SluggerInterface $slugger)
{
    return $this->render('nueva_pregunta.html.twig');
}
/**
* @Route("/preguntas", name="preguntas")
*/
public function preguntas()
{
    $repositorio = $this->getDoctrine()->getRepository(Preguntas::class);
    $preguntas = $repositorio->findAll();
    return $this->render('lista_preguntas.html.twig', array('preguntas' =>$preguntas));
}
/**
* @Route("/eliminar/pregunta/{id}", name="eliminarPregunta")
*/
public function eliminar($id)
{
    $entityManager = $this->getDoctrine()->getManager();
    $repositorio = $this->getDoctrine()->getRepository(Preguntas::class);
    $pregunta = $repositorio->find($id);
    if($pregunta)
    {
        $entityManager->remove($pregunta);
        $entityManager->flush();
    }
    return $this->redirectToRoute('preguntas');

}
/**
* @Route("/preguntaNueva", name="preguntaNueva")
*/
public function añadir_pregunta(Request $request)
{
    if($request->isXmlHttpRequest())
    {
        $entityManager = $this->getDoctrine()->getManager();
        $datos = $request->request->get("formData");
        $pregunta = new Preguntas();

        $enunciado = $_POST['pregunta'];
        $r1 = $_POST['r1'];
        $r2 = $_POST['r2'];
        $r3 = $_POST['r3'];
        $correcta = $_POST['correcta'];

        $file = $_FILES['image'];
        if($file)
        {
            $name = $_FILES['image']['name'];
            $tmp_name = $_FILES['image']['tmp_name'];
    
            $ruta = __DIR__.'/../../public/uploads';
            $extension = $_FILES['image']['type'];
            $filename = uniqid().'.'.$name;
            $arrayExtensions = ['image/jpeg', 'image/jpg', 'image/png'];
            

            if(in_array($extension, $arrayExtensions))
            {
                $pregunta->setPregunta($enunciado);
                $pregunta->setR1($r1);
                $pregunta->setR2($r2);
                $pregunta->setR3($r3);
                $pregunta->setCorrecta($correcta);
                $pregunta->setFoto('/uploads/'.$filename);

                $entityManager->persist($pregunta);
                $entityManager->flush();
                move_uploaded_file($tmp_name, "$ruta/$filename");
            }
        }
        $pregunta->setPregunta($enunciado);
        $pregunta->setR1($r1);
        $pregunta->setR2($r2);
        $pregunta->setR3($r3);
        $pregunta->setCorrecta($correcta);

        $entityManager->persist($pregunta);
        $entityManager->flush();

        $arr = array('message' => 'Se ha creado la pregunta con éxito', 'title' => 'Pregunta Creada');
    }
    return new JsonResponse($arr);
}
/**
* @Route("/editar/pregunta/{id}", name="editarPregunta")
*/
public function editar_pregunta(Request $request, $id)
    {
        $repositorio = $this->getDoctrine()->getRepository(Preguntas::class);
        $pregunta = $repositorio->find($id);

        return $this->render('editar_pregunta.html.twig', array('pregunta' => $pregunta));
    }
/**
* @Route("/edicionPregunta", name="edicionPregunta")
*/
public function edicion_pregunta(Request $request)
    {
        if($request->isXmlHttpRequest())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $datos = $request->request->get("formData");

            $idPregunta = $_POST['identificador'];
            $enunciado = $_POST['pregunta'];
            $r1 = $_POST['r1'];
            $r2 = $_POST['r2'];
            $r3 = $_POST['r3'];
            $correcta = $_POST['correcta'];

            $repositorio = $this->getDoctrine()->getRepository(Preguntas::class);
            $pregunta = $repositorio->find($idPregunta);

            $file = $_FILES['image'];
            if($file)
            {
                $name = $_FILES['image']['name'];
                $tmp_name = $_FILES['image']['tmp_name'];
        
                $ruta = __DIR__.'/../../public/uploads';
                $extension = $_FILES['image']['type'];
                $filename = uniqid().'.'.$name;
                $arrayExtensions = ['image/jpeg', 'image/jpg', 'image/png'];

                if(in_array($extension, $arrayExtensions))
                {
                    $pregunta->setPregunta($enunciado);
                    $pregunta->setR1($r1);
                    $pregunta->setR2($r2);
                    $pregunta->setR3($r3);
                    $pregunta->setCorrecta($correcta);
                    $pregunta->setFoto('/uploads/'.$filename);

                    $entityManager->persist($pregunta);
                    $entityManager->flush();
                    move_uploaded_file($tmp_name, "$ruta/$filename");
                }
            }
            $pregunta->setPregunta($enunciado);
            $pregunta->setR1($r1);
            $pregunta->setR2($r2);
            $pregunta->setR3($r3);
            $pregunta->setCorrecta($correcta);

            $entityManager->persist($pregunta);
            $entityManager->flush();
            $arr = array('message' => 'Se ha editado la pregunta con éxito', 'title' => 'Pregunta Editada');
        }
        return new JsonResponse($arr);
    }
}