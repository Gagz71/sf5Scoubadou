<?php

namespace App\Form;

use App\Entity\Advert;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdvertType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
              'label' => 'Titre de la nouvelle annonce',
                'attr' => [
                  'class' => 'col-6',
                ],
            ])
            ->add('description', TextareaType::class, [
              'label' => 'Description de la nouvelle annonce',
                'attr' => [
                    'class' => 'col-6',
                ],
            ])
            ->add('urlPicture', UrlType::class, [
              'label' => 'Lien url de la photo principal de l\'annonce',
                'attr' => [
                    'class' => 'col-6',
                ],
            ])

            ->add('dogs', CollectionType::class, [
               'entry_type' => DogType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'label' => false,
                'by_reference' => false,
            ])

            ->add('submit', SubmitType::class, [
               'label' => 'Créer ma nouvelle annonce',
                'attr' => [
                   'class' => 'btn btn-outline-secondary m-auto',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Advert::class,
        ]);
    }
}
