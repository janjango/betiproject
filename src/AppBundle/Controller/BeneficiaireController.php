<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\Beneficiaire;
use AppBundle\Form\BeneficiaireType;

class BeneficiaireController extends Controller {

    /**
     * @Route("/beneficiaire/read", name="read_beneficiaire")
     * @Method("GET")
     */
    public function read_beneficiaireAction(Request $request) {
        // replace this example code with whatever you need
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $users = $this->getDoctrine()->getManager()
                ->getRepository('Jac\UserBundle\Entity\User');
        $menus = $users->getMenus($user->getId());
        $sousMenus = $users->getSousMenus($user->getId());
        
        $beneficiaires= $this->getDoctrine()
            ->getManager()->getRepository('AppBundle:Beneficiaire')
            ->findBy(Array(),Array('libBeneficiaire'=>'ASC'));
        return $this->render('appel/beneficiaire/read_beneficiaire.html.twig', [
            'beneficiaires' => $beneficiaires,
            'sousMenus' => $sousMenus,
            'menus' => $menus
        ]);

    }

    /**
     * Creates a new demand entity.
     *
     * @Route("/beneficiaire/create", name="create_beneficiaire")
     * @Method({"GET", "POST"})
     */
    public function create_beneficiaireAction(Request $request)
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $users = $this->getDoctrine()->getManager()
            ->getRepository('Jac\UserBundle\Entity\User');
        $menus = $users->getMenus($user->getId());
        $sousMenus = $users->getSousMenus($user->getId());

        $beneficiaire = new beneficiaire();
        $form = $this->createForm('AppBundle\Form\BeneficiaireType', $beneficiaire);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($beneficiaire);
            $em->flush();
            $this->addFlash(
                'success', "Enregistrement effectué avec succès !"
            );

            return $this->redirectToRoute('create_beneficiaire');
        }
        return $this->render('appel/beneficiaire/create_beneficiaire.html.twig', [
             'form'   => $form->createView(),
            'sousMenus' => $sousMenus,
            'menus' => $menus
        ]);
    }

    /**
     * Creates a new demand entity.
     *
     * @Route("/beneficiaire/update", name="update_beneficiaire")
     * @Method({"GET", "POST"})
     */
    public function update_beneficiaireAction(Request $request)
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $users = $this->getDoctrine()->getManager()
            ->getRepository('Jac\UserBundle\Entity\User');
        $menus = $users->getMenus($user->getId());
        $sousMenus = $users->getSousMenus($user->getId());

        $beneficiaire = $this->getDoctrine()->getManager()->getRepository('AppBundle:Beneficiaire')
            ->find($request->get('id'));
        $form = $this->createForm('AppBundle\Form\BeneficiaireType', $beneficiaire);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->flush();
            $this->addFlash(
                'warning', "Modification effectué avec succès !"
            );

            return $this->redirectToRoute('read_beneficiaire');
        }
        return $this->render('appel/beneficiaire/update_beneficiaire.html.twig', [
            'form'   => $form->createView(), 'id'   => $request->get('id'),
            'sousMenus' => $sousMenus,
            'menus' => $menus
        ]);
    }

    /**
     * Creates a new demand entity.
     *
     * @Route("/beneficiaire/delete", name="delete_beneficiaire")
     * @Method({"GET", "POST"})
     */
    public function delete_beneficiaireAction(Request $request)
    {
        $beneficiaire = $this->getDoctrine()->getManager()->getRepository('AppBundle:Beneficiaire')
            ->find($request->get('id'));
        if ($request->getMethod() == 'POST'){
            $em = $this->getDoctrine()->getManager();
            $em->remove($beneficiaire);
            $em->flush();
            $this->addFlash(
                'danger', "Suppression effectué avec succès !"
            );

            return $this->redirectToRoute('read_beneficiaire');
        }
        return $this->render('appel/beneficiaire/delete_beneficiaire.html.twig', [
           'id'   => $request->get('id')
        ]);
    }

}
