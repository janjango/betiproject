<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\Exercice;
use AppBundle\Form\ExerciceType;

class ExerciceController extends Controller {

    /**
     * @Route("/exercice/read", name="read_exercice")
     * @Method("GET")
     */
    public function read_exerciceAction(Request $request) {
        // replace this example code with whatever you need

        $exercices= $this->getDoctrine()
            ->getManager()->getRepository('AppBundle:Exercice')
            ->findBy(Array(),Array('libExercice'=>'ASC'));
        return $this->render('appel/exercice/read_exercice.html.twig', [
            'exercices' => $exercices
        ]);

    }

    /**
     * Creates a new demand entity.
     *
     * @Route("/exercice/create", name="create_exercice")
     * @Method({"GET", "POST"})
     */
    public function create_exerciceAction(Request $request)
    {
        $exercice = new Exercice();
        $form = $this->createForm('AppBundle\Form\ExerciceType', $exercice);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($exercice);
            $em->flush();
            $this->addFlash(
                'success', "Enregistrement effectué avec succès !"
            );

            return $this->redirectToRoute('create_exercice');
        }
        return $this->render('appel/exercice/create_exercice.html.twig', [
             'form'   => $form->createView()
        ]);
    }

    /**
     * Creates a new demand entity.
     *
     * @Route("/exercice/update", name="update_exercice")
     * @Method({"GET", "POST"})
     */
    public function update_exerciceAction(Request $request)
    {
        $exercice = $this->getDoctrine()->getManager()->getRepository('AppBundle:Exercice')
            ->find($request->get('id'));
        $form = $this->createForm('AppBundle\Form\ExerciceType', $exercice);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->flush();
            $this->addFlash(
                'success', "Modification effectué avec succès !"
            );

            return $this->redirectToRoute('read_exercice');
        }
        return $this->render('appel/exercice/update_exercice.html.twig', [
            'form'   => $form->createView(), 'id'   => $request->get('id')
        ]);
    }

    /**
     * Creates a new demand entity.
     *
     * @Route("/exercice/delete", name="delete_exercice")
     * @Method({"GET", "POST"})
     */
    public function delete_exerciceAction(Request $request)
    {
        $exercice = $this->getDoctrine()->getManager()->getRepository('AppBundle:Exercice')
            ->find($request->get('id'));
        if ($request->getMethod() == 'POST'){
            $em = $this->getDoctrine()->getManager();
            $em->remove($exercice);
            $em->flush();
            $this->addFlash(
                'success', "Modification effectué avec succès !"
            );

            return $this->redirectToRoute('read_exercice');
        }
        return $this->render('appel/exercice/delete_exercice.html.twig', [
           'id'   => $request->get('id')
        ]);
    }

}
