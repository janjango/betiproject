<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\Encaissement;
use AppBundle\Form\EncaissementType;

/**
 * Home controller.
 *
 * @Route("encaissement")
 */
class EncaissementController extends Controller {

    /**
     * @Route("/read", name="read_encaissement")
     * @Method("GET")
     */
    public function read_encaissementAction(Request $request) {
        // replace this example code with whatever you need

        $exercice= $this->getDoctrine()
            ->getManager()->getRepository('AppBundle:Exercice')
            ->findOneBy(Array('estActif'=>true));

        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $users = $this->getDoctrine()->getManager()
            ->getRepository('Jac\UserBundle\Entity\User');
        $menus = $users->getMenus($user->getId());
        $sousMenus = $users->getSousMenus($user->getId());

        $encaissements= $this->getDoctrine()
            ->getManager()->getRepository('AppBundle:Encaissement')
            ->findBy(Array('exercice'=>$exercice->getId()),Array('id'=>'ASC'));

        return $this->render('encaissement/encaissement/read_encaissement.html.twig', [
            'encaissements' => $encaissements,'exercice'=>$exercice,
            'sousMenus' => $sousMenus,
            'menus' => $menus
        ]);

    }

    /**
     * Creates a new demand entity.
     *
     * @Route("/create", name="create_encaissement")
     * @Method({"GET", "POST"})
     */
    public function create_encaissementAction(Request $request)
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $users = $this->getDoctrine()->getManager()
            ->getRepository('Jac\UserBundle\Entity\User');
        $menus = $users->getMenus($user->getId());
        $sousMenus = $users->getSousMenus($user->getId());
        $encaissement = new Encaissement();
        $form = $this->createForm('AppBundle\Form\EncaissementType', $encaissement);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if($encaissement->getAppel()->getMontantEncaissement()+$encaissement->getMontantEncaisse() > $encaissement->getAppel()->getMontantTtc()){
                $this->addFlash(
                    'danger', "Le montant encaissé est supérieur à celui de l'appel !"
                );
                return $this->render('encaissement/encaissement/create_encaissement.html.twig', [
                    'form'   => $form->createView(),
                    'sousMenus' => $sousMenus,
                    'menus' => $menus
                ]);
            }
            $exercice= $this->getDoctrine()
                ->getManager()->getRepository('AppBundle:Exercice')
                ->findOneBy(Array('estActif'=>true));
            $em = $this->getDoctrine()->getManager();
            $encaissement->setExercice($exercice);
            if($encaissement->getAppel()->getMontantEncaissement()+$encaissement->getMontantEncaisse() == $encaissement->getAppel()->getMontantTtc()){
                $encaissement->getAppel()->setEstSolder(true);
            }
            $em->persist($encaissement);
            $em->flush();

            $this->addFlash(
                'success', "Enregistrement effectué avec succès !"
            );

            return $this->redirectToRoute('create_encaissement');
        }
        return $this->render('encaissement/encaissement/create_encaissement.html.twig', [
             'form'   => $form->createView(),
            'sousMenus' => $sousMenus,
            'menus' => $menus
        ]);
    }

    /**
     * Creates a new demand entity.
     *
     * @Route("/update", name="update_encaissement")
     * @Method({"GET", "POST"})
     */
    public function update_encaissementAction(Request $request)
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $users = $this->getDoctrine()->getManager()
            ->getRepository('Jac\UserBundle\Entity\User');
        $menus = $users->getMenus($user->getId());
        $sousMenus = $users->getSousMenus($user->getId());
        
        $encaissement = $this->getDoctrine()->getManager()->getRepository('AppBundle:Encaissement')
            ->find($request->get('id'));
        $montant =$encaissement->getMontantEncaisse();
        $form = $this->createForm('AppBundle\Form\EncaissementType', $encaissement);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if($encaissement->getAppel()->getMontantEncaissement()+$encaissement->getMontantEncaisse()-$montant > $encaissement->getAppel()->getMontantTtc()){
                $this->addFlash(
                    'danger', "Le montant encaissé est supérieur à celui de l'appel !"
                );
                return $this->render('encaissement/encaissement/update_encaissement.html.twig', [
                    'form'   => $form->createView(), 'id'   => $request->get('id'),
                    'sousMenus' => $sousMenus,
                    'menus' => $menus
                ]);
            }
            $em = $this->getDoctrine()->getManager();
            if($encaissement->getAppel()->getMontantEncaissement()+$encaissement->getMontantEncaisse()-$montant == $encaissement->getAppel()->getMontantTtc()){
                $encaissement->getAppel()->setEstSolder(true);
            }
            $em->flush();
            $this->addFlash(
                'warning', "Modification effectué avec succès !"
            );

            return $this->redirectToRoute('read_encaissement');
        }
        return $this->render('encaissement/encaissement/update_encaissement.html.twig', [
            'form'   => $form->createView(), 'id'   => $request->get('id'),
            'sousMenus' => $sousMenus,
            'menus' => $menus
        ]);
    }

    /**
     * Creates a new demand entity.
     *
     * @Route("/delete", name="delete_encaissement")
     * @Method({"GET", "POST"})
     */
    public function delete_encaissementAction(Request $request)
    {
        $encaissement = $this->getDoctrine()->getManager()->getRepository('AppBundle:Encaissement')
            ->find($request->get('id'));
        if ($request->getMethod() == 'POST'){
            $em = $this->getDoctrine()->getManager();
            $encaissement->getAppel()->setEstSolder(false);
            $em->remove($encaissement);
            $em->flush();
            $this->addFlash(
                'danger', "Suppression effectué avec succès !"
            );

            return $this->redirectToRoute('read_encaissement');
        }
        return $this->render('encaissement/encaissement/delete_encaissement.html.twig', [
           'id'   => $request->get('id')
        ]);
    }

    /**
     * Creates a new demand entity.
     *
     * @Route("/selectinfo", name="selectinfo_encaissement")
     * @Method({"GET"})
     */
    public function selectinfo_encaissementAction(Request $request)
    {
        $encaissement = $this->getDoctrine()->getManager()->getRepository('AppBundle:Encaissement')
            ->find($request->get('id'));


        return $this->render('encaissement/encaissement/info_encaissement.html.twig', [
            'element'   => $encaissement,
        ]);
    }


}
