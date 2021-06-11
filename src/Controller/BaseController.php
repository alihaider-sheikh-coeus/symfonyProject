<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

abstract  class BaseController extends AbstractController
{
    protected function getUser():User
    {
        return parent::getUser();
    }

}
