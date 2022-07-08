<?php

namespace App\Controller\Admin;

use App\Entity\Actor;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ActorCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Actor::class;
    }
}
