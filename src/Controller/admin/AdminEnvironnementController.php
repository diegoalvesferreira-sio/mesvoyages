<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Controller\admin;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request ;
use App\Repository\EnvironnementRepository;
use App\Entity\Environnement;
/**
 * Description of AdminEnvironnementController
 *
 * @author diego
 */
class AdminEnvironnementController extends AbstractController{
    
    private $repository ;
    
    public function __construct(EnvironnementRepository $repository)
    {
        $this->repository = $repository;
    }
    
    #[Route('/admin/environnements', name: 'admin.environnements')]
    public function index(): Response
    {
        $environnements = $this->repository->findAll();

        return $this->render("admin/admin.environnements.html.twig", [
            'environnements' => $environnements
        ]);
    }
    
    
    #[route('/admin/environnements/suppr/{id}', name:'admin.environnement.suppr')] 
    public function suppr(int $id): Response{
        $environnement = $this->repository-> find($id);
        $this ->repository->remove($environnement);
        return $this->redirectToRoute('admin.environnements');
    }
     #[route('/admin/environnemments/ajout',name:'admin.environnements.ajout')]
    public function ajout (Request $request): Response{
        $nomEnvironnement = $request -> get("nom");
        $environnement = new Environnement();
        $environnement -> setNom($nomEnvironnement);
        $this->repository->add($environnement);
        return $this->redirectToRoute('admin.environnements');
    }
}
