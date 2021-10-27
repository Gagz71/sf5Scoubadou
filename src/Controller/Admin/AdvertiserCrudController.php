<?php

namespace App\Controller\Admin;

use App\Entity\Advertiser;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AdvertiserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Advertiser::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
