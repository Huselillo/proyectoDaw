<?php
namespace App\Controller;

use App\Entity\Tests;
use App\Entity\TestsPreguntas;
use App\Entity\Preguntas;
use App\Entity\Usuarios;
use App\Repository\TestPreguntasRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class TestsController extends AbstractController
{
    /**
     * @Route("/tests", name="tests")
     */
    public function tests(){
        return $this->render('tests.html.twig');
    }
    /**
     * @Route("/nuevo/test", name="testNuevo")
     */
    public function nuevoTest(){
        $repositorio = $this->getDoctrine()->getRepository(Preguntas::class);
        $arrayPreguntas= $repositorio->findAll();
        return $this->render('nuevo_test.html.twig', array('arrayPreguntas' =>$arrayPreguntas));
    }
    
    /**
     * @Route("/tests/{tipo}", name="tipo")
     */
    public function testTipo($tipo){
        
        $tipoTest = $this->getDoctrine()->getRepository(Tests::class)->buscarPorTipoTest($tipo);

        return $this->render('teststipo.html.twig', array('tipoTest' =>$tipoTest));
    }
    /**
     * @Route("/test/{id}", name="test")
     */
    public function testId( $id){

            $arrayPreguntas = $this->getDoctrine()->getRepository(TestsPreguntas::class)->buscarPorId($id);
            return $this->render('test.html.twig', array('arrayPreguntas' =>$arrayPreguntas));
    }
    /**
     * @Route("/testValidar", name="testValidar pt-5")
     */
    public function corregir(Request $request){
        
        if($request->isXmlHttpRequest())
        {
            $aux = array();
            $correcta = false;
            $respuestas = $request->request->get("respuestas");
            for ($i=0; $i <count($respuestas) ; $i++) {
                
                $correcta = false;
                $pregunta = $this->getDoctrine()->getRepository(Preguntas::class)->buscarCorrecta($respuestas[$i]['id']);
                if($respuestas[$i]['valor'] == $pregunta[0]['correcta']){
                    $correcta = true;
                }
                array_push($aux, array(
                    "id"=>$respuestas[$i]['id'],
                    "correcta"=>$correcta,
                    "valor"=>$pregunta[0]['correcta']
                ));
            }
            return new JsonResponse($aux);
        }
    }
    /**
     * @Route("/crearTest", name="crearTest")
     */
    public function crearTest(Request $request){
        
        if($request->isXmlHttpRequest())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $preguntas = $request->request->get("preguntas");

            $test = new Tests();
            $repositorio = $this->getDoctrine()->getRepository(Tests::class);
            $array = $repositorio->findAll();
            $numeroId= count($array);
            $numeroId++;
            
            $testsPreguntas = new TestsPreguntas();
            for ($i=0; $i < 10; $i++) { 
                $pregunta = $this->getDoctrine()->getRepository(Preguntas::class)->buscarUnaCorrecta($preguntas[$i]['id']);
                $testsPreguntas->addIdPreguntum($pregunta[0]); 
            }
            
            $tipoTest = $preguntas[10]['tipo'];
            $test->setNumero($numeroId);
            $test->setTipo($tipoTest);
            $testsPreguntas->addIdTest($test);

            $entityManager->persist($test);
            $entityManager->persist($testsPreguntas);

            $entityManager->flush();

            $arr = array('message' => 'Se ha creado con éxito', 'title' => 'Test Creado');
        }
        return new JsonResponse($arr);
    }

    /**
     * @Route("/insertarDatos", name="insertarDatos")
     */
    public function insertar(Request $request){

        if($request->isXmlHttpRequest()){

            $entityManager = $this->getDoctrine()->getManager();
            $usuario = $this->getDoctrine()->getRepository(Usuarios::class);
            $usuario = $this->getUser();

            $datos = $request->request->get("datos");

            $aciertos = $datos[0]['aciertos'];
            $aciertosTotal = $usuario->getAciertosTests();
            $aciertosTotal = $aciertosTotal + $aciertos;
            $usuario->setAciertosTests($aciertosTotal);

            $testRealizados = $usuario->getTestsRealizados();
            $testRealizados++;
            $usuario->setTestsRealizados($testRealizados);

            $aprobado = $datos[0]['aprobado'];
            $aprobadoTotal = $usuario->getTestsAprobados();
            if($aprobado == 1){
                $aprobadoTotal++;
                $usuario->setTestsAprobados($aprobadoTotal);
            }

            $entityManager->persist($usuario);
            $entityManager->flush();


        }
        return new JsonResponse();

        
    }
    /**
    * @Route("/listaTests", name="listaTests")
    */
    public function todosTests()
    {
        $repositorio = $this->getDoctrine()->getRepository(Tests::class);
        $tests = $repositorio->findAll();
        return $this->render('lista_tests.html.twig', array('tests' =>$tests));
    }
    /**
    * @Route("/eliminar/test/{id}", name="eliminarTest")
    */
    public function eliminar($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $repositorio = $this->getDoctrine()->getRepository(Tests::class);
        $test = $repositorio->find($id);
        $repositorio1 = $this->getDoctrine()->getRepository(TestsPreguntas::class);
        $test1 = $repositorio1->find($id);
        if($test && $test1)
        {
            $entityManager->remove($test);
            $entityManager->remove($test1);
            $entityManager->flush();
        }
        return $this->redirectToRoute('listaTests');
    }

}
?>