<?php

namespace App\Controller\Admin;

use App\Entity\Competition;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CompetitionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Competition::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            ImageField::new('logo')
                ->setBasePath('/uploads/competitions')
                ->setUploadDir('public/uploads/competitions')
                ->setRequired(false)
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setHelp('Upload a logo for the competition.'),
        ];
    }
}
