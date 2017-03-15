<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\Coffrefort;
use AppBundle\Form\CoffrefortType;

/**
 * Home controller.
 *
 * @Route("/coffrefort")
 */
class CoffreFortController extends Controller {

    /**
     * @Route("/read", name="read_coffrefort")
     * @Method("GET")
     */
    public function readCoffrefortAction(Request $request) {
        // replace this example code with whatever you need
        $exercice= $this->getDoctrine()
            ->getManager()->getRepository('AppBundle:Exercice')
            ->findOneBy(Array('estActif'=>true));

        
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $users = $this->getDoctrine()->getManager()
                ->getRepository('Jac\UserBundle\Entity\User');
        $menus = $users->getMenus($user->getId());
        $sousMenus = $users->getSousMenus($user->getId());
        $coffreforts= $this->getDoctrine()
            ->getManager()->getRepository('AppBundle:Coffrefort')
            ->findBy(Array('exercice'=>$exercice->getId()),Array('id'=>'ASC'));
        
        return $this->render('coffrefort/read_coffrefort.html.twig', [
            'coffreforts' => $coffreforts,
            'sousMenus' => $sousMenus,
            'exercice'=>$exercice,
            'menus' => $menus
        ]);
    }

    /**
     * Creates a new demand entity.
     *
     * @Route("/create", name="create_coffrefort")
     * @Method({"GET", "POST"})
     */
    public function createCoffrefortAction(Request $request) {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $users = $this->getDoctrine()->getManager()
                ->getRepository('Jac\UserBundle\Entity\User');
        $menus = $users->getMenus($user->getId());
        $sousMenus = $users->getSousMenus($user->getId());

        $coffrefort = new Coffrefort();

        $form = $this->createForm('AppBundle\Form\CoffrefortType', $coffrefort);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            if ($coffrefort->getMontantRetire()+$coffrefort->getEncaissement()->getMontantpaye() > $coffrefort->getEncaissement()->getMontantEncaisse()) {
                $this->addFlash(
                        'danger', "Le montant retiré est supérieur au solde de l'encaissement !"
                );
                return $this->render('coffrefort/create_coffrefort.html.twig', [
                            'form' => $form->createView(),
                            'sousMenus' => $sousMenus,
                            'menus' => $menus
                ]);
            }
            $exercice= $this->getDoctrine()
                ->getManager()->getRepository('AppBundle:Exercice')
                ->findOneBy(Array('estActif'=>true));
            $coffrefort->setExercice($exercice);
            $coffrefort->setUserCreate($this->getUser()->getUsername());
            $coffrefort->setDateCreate(new \ Datetime());
            $coffrefort->setBeneficiaire($coffrefort->getEncaissement()->getAppel()->getBeneficiaire());
            $em->persist($coffrefort);
            //update solde encaissement
           // $this->updateSoldeEncaissement($coffrefort);
            $em->flush();

            $this->addFlash(
                    'success', "Enregistrement effectué avec succès !"
            );

            return $this->redirectToRoute('create_coffrefort');
        }
        return $this->render('coffrefort/create_coffrefort.html.twig', [
                    'form' => $form->createView(),
                    'sousMenus' => $sousMenus,
                    'menus' => $menus
        ]);
        
        
    }

    /**
     * Update a Coffrefort.
     *
     * @Route("/update", name="update_coffrefort")
     * @Method({"GET", "POST"})
     */
    public function updateCoffrefortAction(Request $request) {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $users = $this->getDoctrine()->getManager()
                ->getRepository('Jac\UserBundle\Entity\User');
        $menus = $users->getMenus($user->getId());
        $sousMenus = $users->getSousMenus($user->getId());
        $coffrefort = $this->getDoctrine()->getManager()->getRepository('AppBundle:Coffrefort')
                ->find($request->get('id'));
        $montant =$coffrefort->getMontantRetire();
        $form = $this->createForm('AppBundle\Form\CoffrefortType', $coffrefort);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if($coffrefort->getEncaissement()->getMontantpaye()+$coffrefort->getMontantRetire()-$montant > $coffrefort->getEncaissement()->getMontantEncaisse()){
                $this->addFlash(
                    'danger', "Le montant retiré est supérieur au solde de l'encaissement !"
                );
                return $this->render('coffrefort/update_coffrefort.html.twig', [
                    'form' => $form->createView(), 'id' => $request->get('id'), 'coffrefort' => $coffrefort,
                    'sousMenus' => $sousMenus,
                    'menus' => $menus
                ]);
            }
            $em = $this->getDoctrine()->getManager();
            $coffrefort->setUserModif($this->getUser()->getUsername());
            $coffrefort->setDateModif(new \ Datetime());
            //update solde encaissement
            //$this->updateSoldeEncaissement($coffrefort);
            $coffrefort->setBeneficiaire($coffrefort->getEncaissement()->getAppel()->getBeneficiaire());
            $em->flush();
            $this->addFlash(
                    'warning', "Modification effectué avec succès !"
            );
            return $this->redirectToRoute('read_coffrefort');
        }
        return $this->render('coffrefort/update_coffrefort.html.twig', [
                    'form' => $form->createView(), 'id' => $request->get('id'), 'coffrefort' => $coffrefort,
                    'sousMenus' => $sousMenus,
                    'menus' => $menus
        ]);
    }

    /**
     * Creates a new demand entity.
     *
     * @Route("/delete", name="delete_coffrefort")
     * @Method({"GET", "POST"})
     */
    public function deleteCoffrefortAction(Request $request) {
        $coffrefort = $this->getDoctrine()
                ->getManager()
                ->getRepository('AppBundle:Coffrefort')
                ->find($request->get('id'));
        if ($request->getMethod() == 'POST') {
            $em = $this->getDoctrine()->getManager();
            $em->remove($coffrefort);
            $em->flush();
            $this->addFlash(
                    'danger', "Suppression effectué avec succès !"
            );
            return $this->redirectToRoute('read_coffrefort');
        }
        return $this->render('coffrefort/delete_coffrefort.html.twig', [
            'id' => $request->get('id'),
            'coffrefort' => $coffrefort
        ]);
    }

    /**
     * @Route("/select/encaissemnts", name="coffre_select_encaissemnts")
     */
    public function SelectEncaissementAction(Request $request) {
        $appel_id = (int) $request->request->get('appel_id');
        $em = $this->getDoctrine()->getManager();
        $encaissements = $em->getRepository('AppBundle:Encaissement')->findByAppelId($appel_id);
        return new JsonResponse($encaissements);
    }

//    private function updateSoldeaugmenteEncaissement($coffrefort) {
//        //update solde encaissement
//        $solde = $coffrefort->getEncaissement()->getSolde() + $coffrefort->getMontantRetire();
//        $coffrefort->getEncaissement()->setSolde($solde);
//        return $solde;
//    }
//
//    private function updateSoldediminuEncaissement($coffrefort) {
//        //update solde encaissement
//        $solde = $coffrefort->getEncaissement()->getSolde() - $coffrefort->getMontantRetire();
//        $coffrefort->getEncaissement()->setSolde($solde);
//        return $solde;
//    }

}
