<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Empresa;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Empresa controller.
 *
 * @Route("empresa")
 */
class EmpresaController extends Controller
{
    /**
     * Lists all empresa entities.
     *
     * @Route("/", name="empresa_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $empresas = $em->getRepository('AppBundle:Empresa')->findAll();

        return $this->render('empresa/index.html.twig', array(
            'empresas' => $empresas,
        ));
    }

    /**
     * Creates a new empresa entity.
     *
     * @Route("/new", name="empresa_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $empresa = new Empresa();
        $form = $this->createForm('AppBundle\Form\EmpresaType', $empresa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $empresa->setEstEmp(1);
            $em->persist($empresa);
            $em->flush();

            $ms="La Empresa  ha sido ingresada con exito";
            $this->addFlash('success',"$ms");
            return $this->redirectToRoute('empresa_index', array('id' => $empresa->getId()));
        }

        return $this->render('empresa/new.html.twig', array(
            'empresa' => $empresa,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a empresa entity.
     *
     * @Route("/{id}", name="empresa_show")
     * @Method("GET")
     */
  /*  public function showAction(Empresa $empresa)
    {
        $deleteForm = $this->createDeleteForm($empresa);

        return $this->render('empresa/show.html.twig', array(
            'empresa' => $empresa,
            'delete_form' => $deleteForm->createView(),
        ));
    }*/

    /**
     * Displays a form to edit an existing empresa entity.
     *
     * @Route("/{id}/edit", name="empresa_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Empresa $empresa)
    {

        $editForm = $this->createForm('AppBundle\Form\EmpresaType', $empresa);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $ms="La Empresa  ha sido modificada con exito";
            $this->addFlash('success',"$ms");
            return $this->redirectToRoute('empresa_index', array('id' => $empresa->getId()));
        }

        return $this->render('empresa/edit.html.twig', array(
            'empresa' => $empresa,
            'edit_form' => $editForm->createView()
        ));
    }

    /**
     * Deletes a empresa entity.
     *
     * @Route("/{id}", name="empresa_delete")
     *
     */
    public function deleteAction(Request $request, $id)
    {

            $em = $this->getDoctrine()->getManager();
            $Empresa=$em->find('AppBundle:Empresa',$id);
            $ms="El cuarto <strong>".$Empresa->getDecEmp()."</strong> ";
            if($Empresa->getEstEmp()==1){
                $Empresa->setEstEmp(0);
                $ms.=" fue Deshabilitadao";
            }else{
                $Empresa->setEstEmp(1);
                $ms.="fue Habilitadao";
            }
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success',"$ms");
            return $this->redirectToRoute('empresa_index');
    }
}
