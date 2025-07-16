<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\ClubMatchday;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class ClubMatchdayCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ClubMatchday::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('competitionSeason')
                ->setRequired(true)
                ->setHelp('Select the competition season for this matchday.'),
            AssociationField::new('club')
                ->setRequired(true)
                ->setHelp('Select the club associated with this matchday.'),
            IntegerField::new('matchday')
                ->setRequired(true)
                ->setHelp('Enter the matchday number.'),
            IntegerField::new('points')
                ->setRequired(true)
                ->setHelp('Enter the points awarded for this matchday.'),
        ];
    }
}
