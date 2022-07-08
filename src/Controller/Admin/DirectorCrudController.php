<?php

namespace App\Controller\Admin;

use App\Entity\Director;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class DirectorCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Director::class;
    }
}
