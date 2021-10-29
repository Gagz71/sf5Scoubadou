<?php

namespace App\Form;

use App\Entity\Dog;
use App\Entity\Race;
use App\Entity\UrlPicture;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DogType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
			  'label' => 'Nom'
            ])
            ->add('antecedents', TextType::class, [
			  'label' => 'Antécédents '
            ])
            ->add('lof')
            ->add('fullDescription', TextareaType::class, [
			  'label' => 'Description'
            ])
            ->add('sociable', ChoiceType::class, [
			  'label' => 'Accepte les autres animaux',
			  'choices' => [
				  'Yes' => true,
				  'No' => false
			  ],
            ])
            ->add('isAdopted', ChoiceType::class, [
			  'label' => 'Statut',
			  'choices' => [
				  'Adopté' => true,
				  'Pas encore adopté' => false
			  ]
            ])
	        
            ->add('races', EntityType::class, [
			  'label' => 'Race',
			  'class' => Race::class,
	            'choice_label' => 'name',
	            'multiple' => true,
	            'expanded' => true,
            ])
	        
	      
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Dog::class,
        ]);
    }
}
