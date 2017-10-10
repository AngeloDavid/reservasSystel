<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Room;
use function PHPSTORM_META\type;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class RoomController extends Controller
{

    /**
     * @Route("/Room", name="roompage")
     */
    public function indexAction(Request $request)
    {
        $Room= new Room();
        $form= $this->createFormBuilder($Room)
            ->add('desRoom',TextType::class,array('label'=>'Descripcion:','required'=>true))
            ->add('capRoom',IntegerType::class,array('label'=>'Capacidad:'))
            ->add('tipRoom',ChoiceType::class,array('label'=>'Tipo de Room:','choices'  => array(
                'Laboratorio' => 'Lab',
                'Sala de Reuniones' => 'Sal',
                'Oficina' => 'Ofi',
                'Aula' => 'Aul',
                'Otro' => 'Otr'
            ),'required'=>true))
            ->add('ObsRoom',TextareaType::class,array('label'=>'Observaciones:'))
            ->add('Guardar',SubmitType::class)
            ->getForm();
        $form->handleRequest($request);

        $Rooms=$this->roomAll();
        if($form->isSubmitted()&& $form->isValid()){

            $Room->setDesRoom($form->get('desRoom')->getData());
            $Room->setCapRoom($form->get('capRoom')->getData());
            $Room->setTipRoom($form->get('tipRoom')->getData());
            $Room->setObsRoom($form->get('ObsRoom')->getData());
            $Room->setEstRoom(1);

            $em=$this->getDoctrine()->getManager();
            $em->persist($Room);
            $em->flush();
            $Rooms=$this->roomAll();
            $ms="Room  ingreado con exito";
            $this->addFlash('success',"$ms");
            return $this->render("Room/index.html.twig",array("Rooms"=>$Rooms,"Room"=>$Room, "form"=>$form->createView()));
        }
        // replace this example code with whatever you need
//        return $this->render('Room/index.html.twig');
        return $this->render("Room/index.html.twig",array("Rooms"=>$Rooms,"Room"=>null, "form"=>$form->createView()));
    }
    /**
     * @Route("/Room/get", options={"expose"=true}, name="getRoom")
     */
    public function editRoomAction(Request $request)
    {
        // verificar que solo se puede acceder a este controlador mediante una llamada ajax
        if ($request->isXMLHttpRequest()) {
            $id = $request->get('id');
            $em = $this->getDoctrine()->getManager();
            $room = $em->find("AppBundle:Room", $id);
        }else{
            $this->addFlash('error','Acion no permitida');
            return $this->redirectToRoute('roompage');
        }
        if ($room==null){
            $ms="Ese Room con id=".$id." no EXISTE";
            $this->addFlash('error',"$ms");
            return $this->redirectToRoute("catgegoria_index");
        }else {
            $form= $this->createFormBuilder($room)
                ->add('id',HiddenType::class,array())
                ->add('desRoom',TextType::class,array('label'=>'Descripcion:','required'=>true))
                ->add('capRoom',IntegerType::class,array('label'=>'Capacidad:'))
                ->add('tipRoom',ChoiceType::class,array('label'=>'Tipo de Room:','choices'  => array(
                    'Laboratorio' => 'Lab',
                    'Sala de Reuniones' => 'Sal',
                    'Oficina' => 'Ofi',
                    'Aula' => 'Aul',
                    'Otro' => 'Otr'
                ),'required'=>true))

                ->add('ObsRoom',TextareaType::class,array('label'=>'Observaciones:'))
                ->getForm();
            $form->handleRequest($request);
            if($form->isValid()){
                return new JsonResponse(array('status'=>'succeess'));
            }
            // Obtener solo el HTML del render no las cabeceras
            $roomsform_html = $this->render('Room/detRoom.html.twig',array(
                'formDet'=> $form->createView()
            ))->getContent();

            return new JsonResponse(array('roomsform_html' => $roomsform_html));
        }

    }

    /**
     * @Route("/Room/editar", options={"expose"=true}, name="editRoom")
     */
    public function edit2RoomAction(Request $request)
    {
        if (!$request->isXMLHttpRequest()) {
            $this->addFlash('error','Acion no permitida');
            return $this->redirectToRoute('roompage');
        }else{
            $id = $request->get('id');
            $em = $this->getDoctrine()->getManager();
            $room = $em->find("AppBundle:Room", $id);
            $ms="El cuarto <strong>".$room->getDesRoom()."</strong> ha sido Modficado ";

            $room->setDesRoom($request->get('desp'));
            $room->setCapRoom($request->get('cap'));
            $room->setTipRoom($request->get('tip'));
            $room->setObsRoom($request->get('obs'));

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            // obtener la lista de comentarios actualizada
            $roomslist= $this->roomAll();
            // Obtener solo el HTML del render no las cabeceras
            $roomslist_html = $this->render('Room/listRoom.html.twig',array(
                'Rooms'=> $roomslist
            ))->getContent();


            return new JsonResponse(array(
                    'tymes'=>'success',
                    'mensaje' => $ms,
                    'roomslist_html' => $roomslist_html
                )
            );


        }
    }

    /**
     *
     * @Route("/sa/categorias/editar/{id}",name="Categoria_edit",requirements={"id": "\d+"});
     *
     */
    public function editCatAction(Request $request,$id){
        $categorias= $this->catAll();
        $em=$this->getDoctrine()->getManager();
        $categoria=$em->find('AppBundle:Categoria',$id);

        if ($categoria==null){
            $ms="La categoria con id=".$id." no EXISTE";
            $this->addFlash('error',"$ms");
            return $this->redirectToRoute("roompage");
        }else {
            try {
                $form = $this->createForm(CategoriaType::class, $categoria);
                $form->handleRequest($request);
                if ($form->isSubmitted() && $form->isValid()) {
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($categoria);
                    $em->flush();
                    $ms = "Categoria modificada con id " . $id;
                    $this->addFlash('success', "$ms");
                    return $this->redirectToRoute("catgegoria_index");
                    //return $this->render("sa/categorias.html.twig",array("menssaje"=>$ms,"categorias"=>$categorias,"categoria"=>$categoria,"form"=>$form->createView()));
                }
            } catch (\PDOException $exception) {
                $this->addFlash('error', "Error!, no puede haber dos categorias con el mismo nombre");
                return $this->redirectToRoute("catgegoria_index");
            }

        }
        return $this->render("sa/categorias.html.twig",array("categorias"=>$categorias,"form2"=>$form->createView()));

    }



    /**
     * @Route("/Room/delete", options={"expose"=true}, name="deleteRoom")
     */
    public function deleteRoomAction(Request $request)
    {
        // verificar que solo se puede acceder a este controlador mediante una llamada ajax
        if ($request->isXMLHttpRequest()) {
            $id = $request->get('id');
            $em = $this->getDoctrine()->getManager();
            $room = $em->find("AppBundle:Room", $id);

            $ms="El cuarto <strong>".$room->getDesRoom()."</strong> ha sido elimnado ";
            if($room->getEstRoom()==1){
                $room->setEstRoom(0);
                $ms.=" fue Deshabilitadao";
            }else{
                $room->setEstRoom(1);
                $ms.="fue Habilitadao";
            }
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            // obtener la lista de comentarios actualizada
            $roomslist= $this->roomAll();
            // Obtener solo el HTML del render no las cabeceras
            $roomslist_html = $this->render('Room/listRoom.html.twig',array(
                'Rooms'=> $roomslist
            ))->getContent();

            // Enviar la respuesta codificada como json
            return new JsonResponse(array(
                    'tymes'=>'success',
                    'mensaje' => $ms,
                    'roomslist_html' => $roomslist_html
                )
            );
        }else{
            $this->addFlash('error','Acion no permitida');
            return $this->redirectToRoute('roompage');
        }
    }



    //Metodos
    private function roomAll(){
        $em=$this->getDoctrine()->getManager();
        $room= $em->getRepository('AppBundle:Room')->findAll();
        return $room;
    }

}
