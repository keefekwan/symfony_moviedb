<?php
// src/General/MoviedbBundle/Form/MovieType.php

namespace General\MoviedbBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MovieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('released')
            ->add('genre')
            ->add('synopsis')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'General\MoviedbBundle\Entity\Movie',
        ));
    }

    public function getName()
    {
        return 'addmovie';
    }
}