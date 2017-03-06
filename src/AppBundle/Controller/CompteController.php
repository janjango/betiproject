<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\Compte;
use AppBundle\Form\CompteType;

class CompteController extends Controller {

    /**
     * @Route("/compte/read", name="read_compte")
     * @Method("GET")
     */
    public function read_compteAction(Request $request) {
        // replace this example code with whatever you need

        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $users = $this->getDoctrine()->getManager()
            ->getRepository('Jac\UserBundle\Entity\User');
        $menus = $users->getMenus($user->getId());
        $sousMenus = $users->getSousMenus($user->getId());

        $beneficiaire=$this->getDoctrine()
            ->getManager()->getRepository('AppBundle:Beneficiaire')->find($request->get('id'));
        $comptes= $this->getDoctrine()
            ->getManager()->getRepository('AppBundle:Compte')
            ->findBy(Array('beneficiaire'=>$beneficiaire->getId()));

        return $this->render('appel/compte/read_compte.html.twig', [
            'comptes' => $comptes,
            'beneficiaire' => $beneficiaire,
            'sousMenus' => $sousMenus,
            'menus' => $menus
        ]);

    }

    /**
     * Creates a new demand entity.
     *
     * @Route("/compte/create", name="create_compte")
     * @Method({"GET", "POST"})
     */
    public function create_compteAction(Request $request)
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $users = $this->getDoctrine()->getManager()
            ->getRepository('Jac\UserBundle\Entity\User');
        $menus = $users->getMenus($user->getId());
        $sousMenus = $users->getSousMenus($user->getId());
        $beneficiaire=$this->getDoctrine()
            ->getManager()->getRepository('AppBundle:Beneficiaire')->find($request->get('id'));
        $compte = new Compte();
        $compte->setBeneficiaire($beneficiaire);

        $form = $this->createForm('AppBundle\Form\CompteType', $compte);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($compte);
            $em->flush();
            $this->addFlash(
                'success', "Enregistrement effectué avec succès !"
            );

            return $this->redirectToRoute('create_compte', Array('id'=>$beneficiaire->getId()));
        }
        return $this->render('appel/compte/create_compte.html.twig', [
             'form'   => $form->createView(),
            'sousMenus' => $sousMenus,
            'id' => $beneficiaire->getId(),
            'menus' => $menus
        ]);
    }

    /**
     * Creates a new demand entity.
     *
     * @Route("/compte/update", name="update_compte")
     * @Method({"GET", "POST"})
     */
    public function update_compteAction(Request $request)
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $users = $this->getDoctrine()->getManager()
            ->getRepository('Jac\UserBundle\Entity\User');
        $menus = $users->getMenus($user->getId());
        $sousMenus = $users->getSousMenus($user->getId());

        $compte = $this->getDoctrine()->getManager()->getRepository('AppBundle:Compte')
            ->find($request->get('id'));
        $form = $this->createForm('AppBundle\Form\CompteType', $compte);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->flush();
            $this->addFlash(
                'warning', "Modification effectué avec succès !"
            );

            return $this->redirectToRoute('read_compte', Array('id'=>$compte->getBeneficiaire()->getId()));
        }
        return $this->render('appel/compte/update_compte.html.twig', [
            'form'   => $form->createView(), 'id'   => $request->get('id'),
            'sousMenus' => $sousMenus,
            'menus' => $menus,
            'element' => $compte
        ]);
    }

    /**
     * Creates a new demand entity.
     *
     * @Route("/compte/delete", name="delete_compte")
     * @Method({"GET", "POST"})
     */
    public function delete_compteAction(Request $request)
    {
        $compte = $this->getDoctrine()->getManager()->getRepository('AppBundle:Compte')
            ->find($request->get('id'));
        if ($request->getMethod() == 'POST'){
            $em = $this->getDoctrine()->getManager();
            $em->remove($compte);
            $em->flush();
            $this->addFlash(
                'danger', "Suppression effectué avec succès !"
            );

            return $this->redirectToRoute('read_compte', Array('id'=>$compte->getBeneficiaire()->getId()));
        }
        return $this->render('appel/compte/delete_compte.html.twig', [
           'id'   => $request->get('id')
        ]);
    }

}
