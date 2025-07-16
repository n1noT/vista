<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\UserPrediction;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class UserPredictionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return UserPrediction::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('user')
                ->setRequired(true),
            AssociationField::new('competitionSeason')
                ->setRequired(true),
            AssociationField::new('club')
                ->setRequired(true),
            IntegerField::new('matchday')
                ->setRequired(true),
            IntegerField::new('predictedPosition')
                ->setRequired(true),
        ];
    }
}
