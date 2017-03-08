<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\RetenuePaie;
use AppBundle\Form\RetenuePaieType;

/**
 * Home controller.
 *
 * @Route("/encaissement")
 */
class RetenuePaieController extends Controller {

    /**
     * @Route("/retenuepaie/read", name="read_retenuepaie")
     * @Method("GET")
     */
    public function read_retenuepaieAction(Request $request) {
        // replace this example code with whatever you need

        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $users = $this->getDoctrine()->getManager()
            ->getRepository('Jac\UserBundle\Entity\User');
        $menus = $users->getMenus($user->getId());
        $sousMenus = $users->getSousMenus($user->getId());

        $paiement=$this->getDoctrine()
            ->getManager()->getRepository('AppBundle:Paiement')->find($request->get('id'));
        $retenuepaies= $this->getDoctrine()
            ->getManager()->getRepository('AppBundle:RetenuePaie')
            ->findBy(Array('paiement'=>$paiement->getId()));

        return $this->render('encaissement/retenuepaie/read_retenuepaie.html.twig', [
            'retenuepaies' => $retenuepaies,
            'paiement' => $paiement,
            'sousMenus' => $sousMenus,
            'menus' => $menus
        ]);

    }

    /**
     * Creates a new demand entity.
     *
     * @Route("/retenuepaie/create", name="create_retenuepaie")
     * @Method({"GET", "POST"})
     */
    public function create_retenuepaieAction(Request $request)
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $users = $this->getDoctrine()->getManager()
            ->getRepository('Jac\UserBundle\Entity\User');
        $menus = $users->getMenus($user->getId());
        $sousMenus = $users->getSousMenus($user->getId());
        $paiement=$this->getDoctrine()
            ->getManager()->getRepository('AppBundle:Paiement')->find($request->get('id'));
        $retenuepaie = new RetenuePaie();
        $retenuepaie->setPaiement($paiement);

        $form = $this->createForm('AppBundle\Form\RetenuePaieType', $retenuepaie);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if($retenuepaie->getPaiement()->getTvaretenueversee()+$retenuepaie->getTvaAreverse() > $retenuepaie->getPaiement()->getTvaRetenue()){
                $this->addFlash(
                    'danger', "Le montant TVA versé est supérieur au montant TVA retenu !"
                );
                return $this->render('encaissement/retenuepaie/create_retenuepaie.html.twig', [
                    'form'   => $form->createView(),
                    'sousMenus' => $sousMenus,
                    'id' => $paiement->getId(),
                    'menus' => $menus
                ]);
            }
            if($retenuepaie->getPaiement()->getAibretenueversee()+$retenuepaie->getAibAreverse() > $retenuepaie->getPaiement()->getAibRetenu()){
                $this->addFlash(
                    'danger', "Le montant AIB versé est supérieur au montant AIB retenu !"
                );
                return $this->render('encaissement/retenuepaie/create_retenuepaie.html.twig', [
                    'form'   => $form->createView(),
                    'sousMenus' => $sousMenus,
                    'id' => $paiement->getId(),
                    'menus' => $menus
                ]);
            }
            $em = $this->getDoctrine()->getManager();

            $em->persist($retenuepaie);
            $em->flush();
            $this->addFlash(
                'success', "Enregistrement effectué avec succès !"
            );

            return $this->redirectToRoute('create_retenuepaie', Array('id'=>$paiement->getId()));
        }
        return $this->render('encaissement/retenuepaie/create_retenuepaie.html.twig', [
             'form'   => $form->createView(),
            'sousMenus' => $sousMenus,
            'id' => $paiement->getId(),
            'menus' => $menus
        ]);
    }

    /**
     * Creates a new demand entity.
     *
     * @Route("/retenuepaie/update", name="update_retenuepaie")
     * @Method({"GET", "POST"})
     */
    public function update_retenuepaieAction(Request $request)
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $users = $this->getDoctrine()->getManager()
            ->getRepository('Jac\UserBundle\Entity\User');
        $menus = $users->getMenus($user->getId());
        $sousMenus = $users->getSousMenus($user->getId());

        $retenuepaie = $this->getDoctrine()->getManager()->getRepository('AppBundle:RetenuePaie')
            ->find($request->get('id'));
        $montanttva =$retenuepaie->getTvaAreverse();
        $montantaib =$retenuepaie->getAibAreverse();
        $form = $this->createForm('AppBundle\Form\RetenuePaieType', $retenuepaie);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if($retenuepaie->getPaiement()->getTvaretenueversee()+$retenuepaie->getTvaAreverse()-$montanttva > $retenuepaie->getPaiement()->getTvaRetenue()){
                $this->addFlash(
                    'danger', "Le montant TVA versé est supérieur au montant TVA retenu !"
                );
                return $this->render('encaissement/retenuepaie/create_retenuepaie.html.twig', [
                    'form'   => $form->createView(),
                    'sousMenus' => $sousMenus, 'element' => $retenuepaie,
                    'id'   => $request->get('id'),
                    'menus' => $menus
                ]);
            }
            if($retenuepaie->getPaiement()->getAibretenueversee()+$retenuepaie->getAibAreverse()-$montantaib > $retenuepaie->getPaiement()->getAibRetenu()){
                $this->addFlash(
                    'danger', "Le montant AIB versé est supérieur au montant AIB retenu !"
                );
                return $this->render('encaissement/retenuepaie/update_retenuepaie.html.twig', [
                    'form'   => $form->createView(),
                    'sousMenus' => $sousMenus, 'element' => $retenuepaie,
                    'id'   => $request->get('id'),
                    'menus' => $menus
                ]);
            }
            $em = $this->getDoctrine()->getManager();

            $em->flush();
            $this->addFlash(
                'warning', "Modification effectué avec succès !"
            );

            return $this->redirectToRoute('read_retenuepaie', Array('id'=>$retenuepaie->getPaiement()->getId()));
        }
        return $this->render('encaissement/retenuepaie/update_retenuepaie.html.twig', [
            'form'   => $form->createView(), 'id'   => $request->get('id'),
            'sousMenus' => $sousMenus,
            'menus' => $menus,
            'element' => $retenuepaie
        ]);
    }

    /**
     * Creates a new demand entity.
     *
     * @Route("/retenuepaie/delete", name="delete_retenuepaie")
     * @Method({"GET", "POST"})
     */
    public function delete_retenuepaieAction(Request $request)
    {
        $retenuepaie = $this->getDoctrine()->getManager()->getRepository('AppBundle:RetenuePaie')
            ->find($request->get('id'));
        if ($request->getMethod() == 'POST'){
            $em = $this->getDoctrine()->getManager();
            $em->remove($retenuepaie);
            $em->flush();
            $this->addFlash(
                'danger', "Suppression effectué avec succès !"
            );

            return $this->redirectToRoute('read_retenuepaie', Array('id'=>$retenuepaie->getPaiement()->getId()));
        }
        return $this->render('encaissement/retenuepaie/delete_retenuepaie.html.twig', [
           'id'   => $request->get('id')
        ]);
    }

}
