<?php

namespace BackOfficeBundle\Form;

use BackOfficeBundle\Entity\Fournisseurs;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Tests\Fixtures\Validation\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EquipementsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('reference')
            ->add('libelle')
            ->add('domaine',ChoiceType::class,array('label'  =>'domaine','placeholder' => 'Domaine','required' => true,
                'choices' => array(
                    'Musculation' => 'Musculation',
                    'Fitness ' => 'Fitness ',
                    'Boxe '   => 'Boxe ',
                    'Lutte Libre' => 'Lutte Libre',
                    'Natation' => 'Natation',
                    'Aerobic sportive'=>'Aerobic sportive',)))
            ->add('salle',ChoiceType::class,array('label'  =>'salle','placeholder' => 'Salle','required' => true,
                'choices' => array(
                    'A1' => 'A1',
                    'A2 ' => 'A2 ',
                    'G1 ' => 'G1 ',
                    'B1' => 'B1',
                    'B2' => 'B2',
                    'N'=>'N',
                    'Atelier'=>'Atelier',)))
            ->add('date')
            ->add('fournisseur',EntityType::class,array('class'=>'BackOfficeBundle\Entity\Fournisseurs','choice_label'=>'nom','placeholder' => 'Fournisseur','required' => true,'multiple' => false))
            ->add('etat',ChoiceType::class,array('label'  =>'etat','placeholder' => 'etat','required' => true,
                'choices' => array(
                    'Fonctionnel' => 'Fonctionnel',
                    'Non Fonctionnel ' => 'Non Fonctionnel ',
                    'En maintenance '   => 'En maintenance ',
                )));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BackOfficeBundle\Entity\Equipements'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'backofficebundle_equipements';
    }


}
