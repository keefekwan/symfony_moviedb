<?php

namespace General\MoviedbBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use General\MoviedbBundle\Entity\Movie;
use General\MoviedbBundle\Form\MovieType;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $movies = $em->getRepository('GeneralMoviedbBundle:Movie')
            ->getMovies();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $movies, $this->get('request')->query->get('page', 1), 5
        );


        return $this->render('GeneralMoviedbBundle:Default:index.html.twig', array(
            'movies' => $movies,
            'pagination' => $pagination,
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

    public function deleteAction(Request $request,$id)
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
        $data = $request->get->all();
        $repo = $this->getDoctrine()->getRepository('GeneralMoviedbBundle:Movie');

        $query = $repo->createQueryBuilder('m')
            ->where('m.title LIKE :title')
            ->setParamter('title', '%' . $data['search'] . '%')
            ->getQuery();

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query->getResults(),
            $this->request->get('page', 1), 4
        );
        return $this->render('GeneralMoviedbBundle:Default:index.html.twig', array(
            'pagination' => $pagination,
        ));
    }
}
