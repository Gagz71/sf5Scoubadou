<?php

namespace App\Form;

use App\Entity\Discussion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class DiscussionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('content', TextareaType::class, [
			  'label' => 'Contenu du message',
	            'constraints' => [
				  new NotBlank([
					  'message' => 'Veuillez saisir votre message'
				  ]),
		            new Length([
					  'min' => 200,
			            'max' => 12000,
			            'minMessage' => 'Votre message doit contenir au minimum 200 caractères',
			            'maxMessage' => 'Votre message ne peut contenir qu\'au maximum 12 000 caractères',
		            ]),
            ],
	   ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Discussion::class,
        ]);
    }
}
