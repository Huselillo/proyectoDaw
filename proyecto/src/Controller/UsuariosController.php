<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Usuarios;
use App\Entity\Practicas;
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
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class UsuariosController extends AbstractController
{
    /**
     * @Route("/registrar", name="registrar")
     */
    public function registrar( Request $request, UserPasswordEncoderInterface $passwordEncoder) 
    {
        $user = new Usuarios();
        $formulario = $this->createFormBuilder($user)
            ->add('nombre', TextType::class,['attr' => ['class' => 'my-1' ]], array('label' => 'Nombre'))
            ->add('apellidos', TextType::class,['attr' => ['class' => 'my-1' ]], array('label' => 'Apellidos'))
            ->add('usuario', TextType::class, ['attr' => ['class' => 'my-1' ]],array(
                'label' => 'Nombre de usuario'
            ))
            ->add('correo', EmailType::class, ['attr' => ['class' => 'my-1' ]],array('label' => 'Correo:'))
            ->add('contrasena', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options' => array('label' => 'Contraseña'),
                'second_options' => array('label' => 'Repite la contraseña')
            ))
            ->add('tipo_usuario', HiddenType::class, array(
                'empty_data' => 'ROLE_USER'
            ))
            ->add('Crear', SubmitType::class, ['attr' => ['class' => 'btn btn-info my-5' ]],array('label' => 'Crear'))
            ->getForm();

        $formulario->handleRequest($request);

        if ($formulario->isSubmitted() && $formulario->isValid()) {
            $user = $formulario->getData();
            $password = $passwordEncoder->encodePassword(
                $user,
                $user->getContrasena()
            );
            $user->setContrasena($password);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('inicio');
        }

        return $this->render('registro.html.twig', array(
            'formulario' => $formulario->createView()
        ));
    }
    /**
     * @Route("/cambiarPass", name="cambiarPass")
     */
    public function cambiarPass( Request $request, UserPasswordEncoderInterface $passwordEncoder) 
    {
        if($request->isXmlHttpRequest())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $datos = $request->request->get("datos");

            $pass1 = $datos[0]['pass1'];
            $pass2 = $datos[0]['pass2'];
            if($pass1 == $pass2)
            {
                $usuario = $this->getDoctrine()->getRepository(Usuarios::class);
                $usuario = $this->getUser();
                $password = $passwordEncoder->encodePassword($usuario,$pass1);

                $usuario->setContrasena($password);
                $entityManager->persist($usuario);
                $entityManager->flush();

                $arr = array('message' => 'Se ha actualizado la contraseña con éxito', 'title' => 'Contraseña cambiada');

                return new JsonResponse($arr);
            }

        }
        return $this->render('cambiarPass.html.twig');
    }
    /**
     * @Route("/registrarProfesor", name="registrarProfesor")
     */
    public function registrarProfesor( Request $request, UserPasswordEncoderInterface $passwordEncoder) 
    {
        $user = new Usuarios();
        $formulario = $this->createFormBuilder($user)
            ->add('nombre', TextType::class, array('label' => 'Nombre'))
            ->add('apellidos', TextType::class, array('label' => 'Apellidos'))
            ->add('usuario', TextType::class, array(
                'label' => 'Nombre de usuario'
            ))
            ->add('correo', EmailType::class, array('label' => 'Correo:'))
            ->add('contrasena', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options' => array('label' => 'Contraseña'),
                'second_options' => array('label' => 'Repite la contraseña')
            ))
            ->add('tipo_usuario', HiddenType::class, array(
                'empty_data' => 'ROLE_PROFESOR'
            ))
            ->add('save', SubmitType::class, array('label' => 'Crear'))
            ->getForm();

        $formulario->handleRequest($request);

        if ($formulario->isSubmitted() && $formulario->isValid()) {
            $user = $formulario->getData();
            $password = $passwordEncoder->encodePassword(
                $user,
                $user->getContrasena()
            );
            $user->setContrasena($password);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('inicio');
        }

        return $this->render('registro_profesores.html.twig', array(
            'formulario' => $formulario->createView()
        ));
    }
    /**
     * @Route("/perfil", name="perfil")
     */
    public function perfil() 
    {
        $usuario = $this->getDoctrine()->getRepository(Usuarios::class);
        $usuario = $this->getUser();

        return $this->render('perfil.html.twig',array('usuario' =>$usuario));
    }
    /**
     * @Route("/estadisticas", name="estadisticas")
     */
    public function estadisticas(Request $request) 
    {
        
        if($request->isXmlHttpRequest())
        {
            $usuario = $this->getDoctrine()->getRepository(Usuarios::class);
            $usuario = $this->getUser();

            $aux = array();

            $testRealizados = $usuario->getTestsRealizados();
            $aciertosTotales = $usuario->getAciertosTests();
            $testAprobados = $usuario->getTestsAprobados();
            $practicasRealizadas = $usuario->getPracticasRealizadas();
            array_push($aux, array(
                "testRealizados"=>$testRealizados,
                "aciertosTotales"=>$aciertosTotales,
                "testAprobados"=>$testAprobados,
                "practicasRealizadas"=>$practicasRealizadas,

            ));
            return new JsonResponse($aux);

        }
        return $this->render('estadisticas.html.twig');
    }
    /**
     * @Route("/actualizarPerfil", name="actualizarPerfil")
     */
    public function actualizar(Request $request){
        
        if($request->isXmlHttpRequest())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $respuestas = $request->request->get("datos");
            $usuario = $this->getDoctrine()->getRepository(Usuarios::class);
            $usuario = $this->getUser();

            $nombre = $respuestas[0]['nombre'];
            $apellido = $respuestas[0]['apellido'];
            $correo = $respuestas[0]['correo'];
            $user = $respuestas[0]['usuario'];

            $usuario->setUsuario($user);
            $usuario->setNombre($nombre);
            $usuario->setApellidos($apellido);
            $usuario->setCorreo($correo);

            $entityManager->persist($usuario);
            $entityManager->flush();

            $arr = array('message' => 'Se ha actualizado el perfil con éxito', 'title' => 'Perfil actualizado');


            return new JsonResponse($arr);
        }
    }
    /**
     * @Route("/solicitarPracticas", name="solicitarPracticas")
     */
    public function solicitarPracticas(){
        $repositorio = $this->getDoctrine()->getRepository(Usuarios::class);
        $arrayProfesores= $repositorio->findAll();
        return $this->render('solicitar_practicas.html.twig', array('arrayProfesores' =>$arrayProfesores));
    }
    /**
     * @Route("/practicas", name="practicas")
     */
    public function practicas(){

        $repositorio = $this->getDoctrine()->getRepository(Practicas::class);
        $usuario = $this->getDoctrine()->getRepository(Usuarios::class);
        $usuario = $this->getUser();
        if($usuario->getTipoUsuario() == 'ROLE_PROFESOR')
        {
            $profesorId = $usuario->getId();
            $arrayPracticas= $repositorio->buscarPorIdProfesor($profesorId);
            return $this->render('practicas.html.twig', array('arrayPracticas' =>$arrayPracticas));
        }
        $usuarioId = $usuario->getId();
        $arrayPracticas= $repositorio->buscarPorId($usuarioId);

        return $this->render('practicas.html.twig', array('arrayPracticas' =>$arrayPracticas));
    }
    /**
     * @Route("/solicitudPractica", name="solicitudPractica")
     */
    public function datosPractica(Request $request){
        
        if($request->isXmlHttpRequest())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $practica = new Practicas();
            $usuario = $this->getDoctrine()->getRepository(Usuarios::class);
            $usuario = $this->getUser();
            $usuarioId = $usuario->getId();
            $datos = $request->request->get("cita");

            $practica->setUsuario($usuario->getNombre());
            $practica->setIdUsuario($usuario);
            $practica->setIdProfesor($datos[0]['profesor']);
            $practica->setProfesor($datos[0]['nombreProfesor']);
            $practica->setFecha($datos[0]['fecha']);
            $practica->setHora($datos[0]['hora']);

            $entityManager->persist($practica);
            $entityManager->flush();

            $arr = array('message' => 'Se ha solicitado la práctica con éxito', 'title' => 'Práctica solicitada');

            return new JsonResponse($arr);
        }
    }
    /**
     * @Route("/realizarPractica", name="realizarPractica")
     */
    public function realizarPractica(Request $request){
        
        if($request->isXmlHttpRequest())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $repositorioUsuarios = $this->getDoctrine()->getRepository(Usuarios::class);
            $repositorioPracticas = $this->getDoctrine()->getRepository(Practicas::class);

            $datos = $request->request->get("datos");

            $usuario = $repositorioUsuarios->find($datos[0]['idUsuario']);
            $practica = $repositorioPracticas->find($datos[0]['idPractica']);

            $practicasRealizadas = $usuario->getPracticasRealizadas();
            $aux = 1;

            $usuario->setPracticasRealizadas($practicasRealizadas+$aux);
            $practica->setRealizada(1);


            $entityManager->persist($practica);
            $entityManager->persist($usuario);
            $entityManager->flush();

            $arr = array('message' => 'Se ha realizado la práctica con éxito', 'title' => 'Práctica realizada');

            return new JsonResponse($arr);
        }
    }
    /**
     * @Route("/confirmarPractica", name="confirmarPractica")
     */
    public function confirmar(Request $request){
        
        if($request->isXmlHttpRequest())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $datos = $request->request->get("datos");
            $arr = array();
            if($datos[0]['accion'] == 'confirmar')
            {
                $repositorio = $this->getDoctrine()->getRepository(Practicas::class);
                $practica = $repositorio->find($datos[0]['idPractica']);
                $practica->setConfirmado('1');
                $entityManager->persist($practica);
                $entityManager->flush();
                $arr = array('message' => 'Has confirmado la practica con éxito', 'title' => 'Práctica confirmada');
            }
            else
            {
                $repositorio = $this->getDoctrine()->getRepository(Practicas::class);
                $practica = $repositorio->find($datos[0]['idPractica']);
                $practica->setConfirmado('2');
                $entityManager->persist($practica);
                $entityManager->flush();
                $arr = array('message' => 'Has cancelado la practica con éxito', 'title' => 'Práctica cancelada');
            }

            return new JsonResponse($arr);
        }
    }
    /**
     * @Route("/listaUsuarios", name="listaUsuarios")
     */
    public function listar_usuarios(){
        
        $usuarios = $this->getDoctrine()->getRepository(Usuarios::class)->findAll();

        return $this->render('lista_usuarios.html.twig', array('usuarios' =>$usuarios));
    }
    /**
     * @Route("/listaAlumnos", name="listaAlumnos")
     */
    public function lista_alumnos(){

        $tipo = 'ROLE_USER';
        $usuarios = $this->getDoctrine()->getRepository(Usuarios::class)->buscarPorTipoUsuario($tipo);

        return $this->render('lista_alumnos.html.twig', array('usuarios' =>$usuarios));
    }
    /**
     * @Route("/enviarAlumnos", name="enviarAlumnos")
     */
    public function listar_alumnos(Request $request){
        if($request->isXmlHttpRequest())
        {
            $tipo = 'ROLE_USER';
            $usuarios = $this->getDoctrine()->getRepository(Usuarios::class)->buscarPorTipoUsuario($tipo);

            return new JsonResponse($usuarios);
        }

    }
    /**
     * @Route("/listaProfesores", name="listaProfesores")
     */
    public function lista_profesores(){

        $tipo = 'ROLE_PROFESOR';
        $usuarios = $this->getDoctrine()->getRepository(Usuarios::class)->buscarPorTipoUsuario($tipo);

        return $this->render('lista_profesores.html.twig', array('usuarios' =>$usuarios));
    }
    /**
     * @Route("/enviarProfesores", name="enviarProfesores")
     */
    public function listar_profesores(Request $request){
        if($request->isXmlHttpRequest())
        {
            $tipo = 'ROLE_PROFESOR';
            $usuarios = $this->getDoctrine()->getRepository(Usuarios::class)->buscarPorTipoUsuario($tipo);

            return new JsonResponse($usuarios);
        }

    }
    /**
     * @Route("/eliminar/usuario/{id}", name="eliminarUsuario")
     */
    public function eliminar_usuario($id){
        
        $entityManager = $this->getDoctrine()->getManager();
        $repositorio = $this->getDoctrine()->getRepository(Usuarios::class);
        $usuario = $repositorio->find($id);
        $entityManager->remove($usuario);
        $entityManager->flush();
        return $this->redirectToRoute('listaUsuarios');
    }

}
?>
