<?php

namespace BackOfficeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class CoursType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lib')
            ->add('type',ChoiceType::class,array('label'  =>'Type','placeholder'=> 'Domaine','required' => true,
                'choices' => array(
                    'Musculation' => 'Musculation',
                    'Fitness ' => 'Fitness ',
                    'Boxe '   => 'Boxe ',
                    'Lutte Libre' => 'Lutte Libre',
                    'Natation' => 'Natation',
                    'Aerobic sportive'=>'Aerobic sportive',)))
            ->add('salle',NumberType::class,array(
                'label'  =>'Salle',))
            ->add('coachName',ChoiceType::class,array('label'  =>'CoachName','placeholder'=> 'Type','required' => true,
                'choices' => array(
                    'Takoua Riahi' => 'Takoua Riahi',
                    'Houssem Ben Achour ' => 'Houssem Ben Achour',
                    'Sabri Ben Marzouk '   => 'Sabri Ben Marzouk ',
                    'Amine Khemiri' => 'Amine Khemiri',
                    'Firas Matoussi' => 'Firas Matoussi',
                    'Walid Nsiri'=>'Walid Nsiri',)))
            ->add('date',DateType::class, array(
                'label'  =>'Date',
                'widget' => 'single_text',
                'input' => 'datetime',
                'format' => 'yyyy-MM-dd',

                'required' => true))
            ->add('nbPlace',NumberType::class,array(
                'label'  =>'Nombre Place',));

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BackOfficeBundle\Entity\Cours'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'backofficebundle_cours';
    }



}
