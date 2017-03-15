<?php
namespace AppBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\Paiement;
use AppBundle\Form\PaiementType;

/**
 * Home controller.
 *
 * @Route("/encaissement")
 */
class PaiementController extends Controller {
    /**
     * @Route("/paiement/read", name="read_paiement")
     * @Method("GET")
     */
    public function read_paiementAction(Request $request) {
        // replace this example code with whatever you need
        $exercice= $this->getDoctrine()
            ->getManager()->getRepository('AppBundle:Exercice')
            ->findOneBy(Array('estActif'=>true));
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $users = $this->getDoctrine()->getManager()
            ->getRepository('Jac\UserBundle\Entity\User');
        $menus = $users->getMenus($user->getId());
        $sousMenus = $users->getSousMenus($user->getId());
        $paiements= $this->getDoctrine()
            ->getManager()->getRepository('AppBundle:Paiement')
            ->findBy(Array('exercice'=>$exercice->getId()),Array('id'=>'ASC'));
        return $this->render('encaissement/paiement/read_paiement.html.twig', [
            'paiements' => $paiements,'exercice'=>$exercice,
            'sousMenus' => $sousMenus,
            'menus' => $menus
        ]);
    }
    /**
     * Creates a new demand entity.
     *
     * @Route("/paiement/create", name="create_paiement")
     * @Method({"GET", "POST"})
     */
    public function create_paiementAction(Request $request)
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $users = $this->getDoctrine()->getManager()
            ->getRepository('Jac\UserBundle\Entity\User');
        $menus = $users->getMenus($user->getId());
        $sousMenus = $users->getSousMenus($user->getId());
        $paiement = new Paiement();
        $form = $this->createForm('AppBundle\Form\PaiementType', $paiement);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if($paiement->getEncaissement()->getMontantpaye()+$paiement->getMontantTtc() > $paiement->getEncaissement()->getMontantEncaisse()){
                $this->addFlash(
                    'danger', "Le montant payé est supérieur au solde de l'encaissement !"
                );
                return $this->render('encaissement/paiement/create_paiement.html.twig', [
                    'form'   => $form->createView(),
                    'sousMenus' => $sousMenus,
                    'menus' => $menus
                ]);
            }
            $exercice= $this->getDoctrine()
                ->getManager()->getRepository('AppBundle:Exercice')
                ->findOneBy(Array('estActif'=>true));
            $em = $this->getDoctrine()->getManager();
            $paiement->setExercice($exercice);
//            if($paiement->getAppel()->getMontantPaiement()+$paiement->getMontantEncaisse() == $paiement->getAppel()->getMontantTtc()){
//                $paiement->getAppel()->setEstSolder(true);
//            }
            $paiement->setUserCreate($this->getUser()->getUsername());
            $paiement->setDateCreate(new \ Datetime());
            $em->persist($paiement);
            $em->flush();
            $paiement->getEncaissement()->setSolde($paiement->getEncaissement()->getMontantEncaisse()-$paiement->getEncaissement()->getMontantpaye());
            $em->flush();
            $this->addFlash(
                'success', "Enregistrement effectué avec succès !"
            );
            return $this->redirectToRoute('create_paiement');
        }
        return $this->render('encaissement/paiement/create_paiement.html.twig', [
             'form'   => $form->createView(),
            'sousMenus' => $sousMenus,
            'menus' => $menus
        ]);
    }
    /**
     * Creates a new demand entity.
     *
     * @Route("/paiement/update", name="update_paiement")
     * @Method({"GET", "POST"})
     */
    public function update_paiementAction(Request $request)
    {
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $users = $this->getDoctrine()->getManager()
            ->getRepository('Jac\UserBundle\Entity\User');
        $menus = $users->getMenus($user->getId());
        $sousMenus = $users->getSousMenus($user->getId());
        
        $paiement = $this->getDoctrine()->getManager()->getRepository('AppBundle:Paiement')
            ->find($request->get('id'));
        $montant =$paiement->getMontantTtc();
        $form = $this->createForm('AppBundle\Form\PaiementType', $paiement);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if($paiement->getEncaissement()->getMontantpaye()+$paiement->getMontantTtc()-$montant > $paiement->getEncaissement()->getMontantEncaisse()){
                $this->addFlash(
                    'danger', "Le montant payé est supérieur au solde de l'encaissement !"
                );
                return $this->render('encaissement/paiement/update_paiement.html.twig', [
                    'form'   => $form->createView(), 'id'   => $request->get('id'),
                    'sousMenus' => $sousMenus,
                    'menus' => $menus
                ]);
            }
            $em = $this->getDoctrine()->getManager();
//            if($paiement->getAppel()->getMontantPaiement()+$paiement->getMontantEncaisse()-$montant == $paiement->getAppel()->getMontantTtc()){
//                $paiement->getAppel()->setEstSolder(true);
//            }
            $paiement->setUserModif($this->getUser()->getUsername());
            $paiement->setDateModif(new \ Datetime());
            $em->flush();
            $paiement->getEncaissement()->setSolde($paiement->getEncaissement()->getMontantEncaisse()-$paiement->getEncaissement()->getMontantpaye());
            $em->flush();
            $this->addFlash(
                'warning', "Modification effectué avec succès !"
            );
            return $this->redirectToRoute('read_paiement');
        }
        return $this->render('encaissement/paiement/update_paiement.html.twig', [
            'form'   => $form->createView(), 'id'   => $request->get('id'),
            'sousMenus' => $sousMenus,
            'menus' => $menus
        ]);
    }
    /**
     * Creates a new demand entity.
     *
     * @Route("/paiement/delete", name="delete_paiement")
     * @Method({"GET", "POST"})
     */
    public function delete_paiementAction(Request $request)
    {
        $paiement = $this->getDoctrine()->getManager()->getRepository('AppBundle:Paiement')
            ->find($request->get('id'));
        $montant =$paiement->getMontantTtc();
        if ($request->getMethod() == 'POST'){
            $em = $this->getDoctrine()->getManager();
            //$paiement->getAppel()->setEstSolder(false);
            $em->remove($paiement);
            $paiement->getEncaissement()->setSolde($paiement->getEncaissement()->getMontantEncaisse()-$paiement->getEncaissement()->getMontantpaye()+$montant);
            $em->flush();
            $this->addFlash(
                'danger', "Suppression effectué avec succès !"
            );
            return $this->redirectToRoute('read_paiement');
        }
        return $this->render('encaissement/paiement/delete_paiement.html.twig', [
           'id'   => $request->get('id')
        ]);
    }
}