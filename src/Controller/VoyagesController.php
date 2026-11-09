<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\VisiteRepository;

class VoyagesController extends AbstractController
{
    /**
     * @var VisiteRepository
     */
    private $repository;

    public function __construct(VisiteRepository $repository)
    {
        $this->repository = $repository;
    }

    #[Route('/voyages', name: 'voyages')]
    public function index(): Response
    {
        $visite = $this->repository->findAllOrderBy('datecreation','DESC');

        return $this->render("pages/voyages.html.twig", [
            'visites' => $visite
        ]);
    }
    #[Route('/voyages/tri/{champ}/{ordre}',name: 'voyages.sort')]
    public function sort($champ,$ordre): Response{
        $visites = $this ->repository->findAllOrderBy($champ,$ordre);
        return $this->render("pages/voyages.html.twig",[
            'visites'=> $visites
        ]);
    }
}
