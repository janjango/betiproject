<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\Exercice;
use AppBundle\Form\ExerciceType;

/**
 * Home controller.
 *
 * @Route("/appel")
 */
class ExerciceController extends Controller {

    /**
     * @Route("/exercice/read", name="read_exercice")
     * @Method("GET")
     */
    public function read_exerciceAction(Request $request) {
        // replace this example code with whatever you need
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $users = $this->getDoctrine()->getManager()
                ->getRepository('Jac\UserBundle\Entity\User');
        $menus = $users->getMenus($user->getId());
        $sousMenus = $users->getSousMenus($user->getId());

        $exercices = $this->getDoctrine()->getManager()
            ->getRepository('AppBundle\Entity\Exercice')->findBy(Array('userdelete'=>null));
        
        return $this->render('appel/exercice/read_exercice.html.twig', [
            'exercices' => $exercices,
            'sousMenus' => $sousMenus,
            'menus' => $menus
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
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $users = $this->getDoctrine()->getManager()
            ->getRepository('Jac\UserBundle\Entity\User');
        $menus = $users->getMenus($user->getId());
        $sousMenus = $users->getSousMenus($user->getId());

        $exercice = new Exercice();
        $exercice->setEstActif(false);
        $exercice->setUserCreate($user->getUsername());
        $exercice->setDateCreate(new \ Datetime());

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
             'form'   => $form->createView(),
            'sousMenus' => $sousMenus,
            'menus' => $menus
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
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $users = $this->getDoctrine()->getManager()
            ->getRepository('Jac\UserBundle\Entity\User');
        $menus = $users->getMenus($user->getId());
        $sousMenus = $users->getSousMenus($user->getId());
        
        $exercice = $this->getDoctrine()->getManager()->getRepository('AppBundle:Exercice')
            ->find($request->get('id'));
        $exercice->setUserModif($user->getUsername());
        $exercice->setDateModif(new \ Datetime());

        $form = $this->createForm('AppBundle\Form\ExerciceType', $exercice);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->flush();
            $this->addFlash(
                'warning', "Modification effectué avec succès !"
            );

            return $this->redirectToRoute('read_exercice');
        }
        return $this->render('appel/exercice/update_exercice.html.twig', [
            'form'   => $form->createView(), 'id'   => $request->get('id'),
            'sousMenus' => $sousMenus,
            'menus' => $menus
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
        $user = $this->container->get('security.token_storage')->getToken()->getUser();

        if ($request->getMethod() == 'POST'){

            $em = $this->getDoctrine()->getManager();
            if ( !$exercice->getAppels()->isEmpty()){
                $this->addFlash(
                    'warring', "Dans cet exercice est enregistré des appels. On ne peut donc pas le supprimer !"
                );
                return $this->redirectToRoute('read_exercice');
            }
            if ( !$exercice->getEncaissements()->isEmpty()){
                $this->addFlash(
                    'warring', "Dans cet exercice est enregistré des encaissement. On ne peut donc pas le supprimer !"
                );
                return $this->redirectToRoute('read_exercice');
            }
            if ( !$exercice->getPaiements()->isEmpty()){
                $this->addFlash(
                    'warring', "Dans cet exercice est enregistré des paiements. On ne peut donc pas le supprimer !"
                );
                return $this->redirectToRoute('read_exercice');
            }
            if ( !$exercice->getCoffreforts()->isEmpty()){
                $this->addFlash(
                    'warring', "Dans cet exercice est enregistré des coffres forts. On ne peut donc pas le supprimer !"
                );
                return $this->redirectToRoute('read_exercice');
            }

            $exercice->setUserdelete($user->getUsername());
            $exercice->setDatedelete(new \ Datetime());

            $em->flush();
            $this->addFlash(
                'danger', "Suppression effectué avec succès !"
            );

            return $this->redirectToRoute('read_exercice');
        }
        return $this->render('appel/exercice/delete_exercice.html.twig', [
            'id'   => $request->get('id')
        ]);
    }

    /**
     * Creates a new demand entity.
     *
     * @Route("/exercice/etat", name="etat_exercice")
     * @Method({"GET", "POST"})
     */
    public function etat_exerciceAction(Request $request)
    {
        $exercice = $this->getDoctrine()->getManager()->getRepository('AppBundle:Exercice')
            ->find($request->get('id'));
        $user = $this->container->get('security.token_storage')->getToken()->getUser();
        $exercice->setEstActif(true);
        $exercice->setUserModif($user->getUsername());
        $exercice->setDateModif(new \ Datetime());

        $exercices= $this->getDoctrine()
            ->getManager()->getRepository('AppBundle:Exercice')
            ->findAll();

        if ($request->getMethod() == 'POST'){
            $em = $this->getDoctrine()->getManager();
            foreach ($exercices  as $i){
                if($i->getId()!= $exercice->getId())
                $i->setEstActif(false);
                $em->flush();
            }
            $this->addFlash(
                'success', "Exercice activé avec succès !"
            );

            return $this->redirectToRoute('read_exercice');
        }
        return $this->render('appel/exercice/etat_exercice.html.twig', [
            'id'   => $request->get('id')
        ]);
    }

}
