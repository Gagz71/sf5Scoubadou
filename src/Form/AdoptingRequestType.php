<?php

namespace App\Form;

use App\Entity\Adopting;
use App\Entity\AdoptingRequest;
use App\Entity\Advert;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdoptingRequestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('status')
            ->add('dogs')
            //imbriquation des champs email,password,lastname, firstname
            ->add('adopting', CollectionType::class, [
                'entry_type' =>AdoptingType::class
            ])
            ->add('discussion', CollectionType::class, [
                'entry_type' =>discussionType::class
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AdoptingRequest::class,
        ]);
    }
}
