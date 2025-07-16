<?php

namespace App\Controller\Admin;

use App\Entity\CompetitionSeason;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class CompetitionSeasonCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CompetitionSeason::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('competition')
                ->setRequired(true),
            AssociationField::new('season')
                ->setRequired(true),
            IntegerField::new('total_matchdays')
        ];
    }
}
