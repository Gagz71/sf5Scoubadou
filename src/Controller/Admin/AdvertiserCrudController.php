<?php

namespace App\Controller\Admin;

use App\Entity\Advertiser;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AdvertiserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Advertiser::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('lastname', 'Votre nom'),
            TextField::new('firstname', 'Votre prénom'),
            TextField::new('organizationName', 'Nom de l\'association'),
            EmailField::new('email', 'Votre email'),
            TextField::new('plainPassword', 'Mot de passe (personnel)')->hideOnIndex(),
        ];
    }
}
