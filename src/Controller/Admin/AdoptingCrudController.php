<?php

namespace App\Controller\Admin;

use App\Entity\Adopting;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\HiddenField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AdoptingCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Adopting::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')-> hideOnForm(),
            TextField::new('lastname','Votre nom'),
            TextField::new('firstname', 'Votre prénom'),
            EmailField::new('email', 'Votre email'),
            TextField::new('plainPassword', 'Mot de passe (personnel)')-> hideOnIndex()


        ];
    }
}