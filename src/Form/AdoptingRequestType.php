<?php

namespace App\Form;

use App\Entity\AdoptingRequest;
use App\Entity\Dog;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class AdoptingRequestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $advert = $options['advert'];
        $builder
            ->add('dogs', EntityType::class, [
                'label' => 'choix des Chiens',
                'class' => Dog::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'by_reference' => false,
                'query_builder' => function (EntityRepository $er) use ($advert) {
                    return $er->createQueryBuilder('d')
                        ->andWhere('d.advert = :advertId')
                        ->setParameter('advertId', $advert->getId())
                        ;
                },
            ])
            //imbriquation des champs email,password,lastname, firstname
            ->add('adopting', AdoptingForRequestType::class, [
                'label' => 'informations de l\'adoptant',
            ])
            ->add('discussions', CollectionType::class, [
                'entry_type' => DiscussionType::class,
                'by_reference' => false,

                'allow_add' => false,

            ])

            ->add('submit', SubmitType::class, [
                'label' => 'i wAnT mY dOg',
                'attr' => [
                    'class' => 'btn btn-outline-secondary m-auto',
                ],
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AdoptingRequest::class,
        ]);
        $resolver->setRequired([
            'advert',
        ]);
    }
}
