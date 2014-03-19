<?php

namespace General\MoviedbBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use General\MoviedbBundle\Entity\Movie;
use General\MoviedbBundle\Form\MovieType;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        // List all results and paginate with KNP
        $em = $this->getDoctrine()->getManager();
        $movie = $em->getRepository('GeneralMoviedbBundle:Movie')
            ->getMovies();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $movie, $this->get('request')->query->get('page', 1), 5
        );

        // Search functionality should be moved to repository
        $results = null;
        $query = $request->query->get('q');

        if (!empty($query)) {
            $em = $this->getDoctrine()->getManager();

            $results = $em->createQueryBuilder()
                ->from('GeneralMoviedbBundle:Movie', 'm')
                ->select('m')
                ->where('m.title LIKE :search')
                ->setParameter(':search', "%${query}%")
                ->getQuery()
                ->getResult();
        }

        return $this->render('GeneralMoviedbBundle:Default:index.html.twig', array(
            'movie' => $movie,
            'pagination' => $pagination,
            'query' => $query,
            'results' => $results,
        ));
    }

    public function createAction(Request $request)
    {
        $entity = new Movie();
        $form = $this->createForm(new MovieType(), $entity);
        $form->submit($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('general_moviedb_homepage', array(
                'released' => $entity->getReleased(),
                'title' => $entity->getTitle(),
                'genre' => $entity->getGenre(),
                'synopsis' => $entity->getSynopsis(),
            )));
        }

        return $this->render('GeneralMoviedbBundle:Default:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GeneralMoviedbBundle:Movie')->findOneById($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find movie');
        }

        $editForm = $this->createForm(new MovieType(), $entity);

        return $this->render('GeneralMoviedbBundle:Default:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GeneralMoviedbBundle:Movie')->findOneById($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find movie');
        }

        $editForm = $this->createForm(new MovieType(), $entity);

        $editForm->submit($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('general_moviedb_homepage', array(
                'id' => $id,
            )));
        }

        return $this->render('MoviedbBundle:Default:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
        ));
    }

    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GeneralMoviedbBundle:Movie')->findOneById($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find movie');
        }

            $em->remove($entity);
            $em->flush();

        return $this->redirect($this->generateUrl('general_moviedb_homepage'));
    }

    public function searchAction(Request $request)
    {
        $results = null;
        $query = $request->query->get('q');

        if (!empty($query)) {
            $em = $this->getDoctrine()->getManager();

            $results = $em->createQueryBuilder()
                ->from('GeneralMoviedbBundle:Movie', 'm')
                ->select('m')
                ->where('m.title LIKE :search')
                ->setParameter(':search', "%${query}%")
                ->getQuery()
                ->getResult();
        }

        return $this->render('GeneralMoviedbBundle:Default:list.html.twig', array(
        'query' => $query,
        'results' => $results,
        ));
    }
}
