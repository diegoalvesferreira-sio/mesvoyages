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
use App\Repository\VisiteRepository;
use App\Form\VisiteType;



class AdminVoyagesController extends AbstractController {
    private $repository;

    public function __construct(VisiteRepository $repository)
    {
        $this->repository = $repository;
    }
    
     #[Route('/admin', name: 'admin.voyages')]
    public function index(): Response
    {
        $visite = $this->repository->findAllOrderBy('datecreation','DESC');

        return $this->render("admin/admin.voyages.html.twig", [
            'visites' => $visite
        ]);
    }
    
    #[route('/admin/suppr/{id}', name:'admin.voyages.suppr')] 
    public function suppr(int $id): Response{
        $visite = $this->repository-> find($id);
        $this ->repository->remove($visite);
        return $this->redirectToRoute('admin.voyages');
    }
    
    #[route('/admin/edit/{id}',name:'admin.voyages.edit')]
    public function edit (int $id, Request $request): Response{
        $visite = $this->repository->find($id);
        $formVisite = $this -> createForm(VisiteType::class,$visite);
        
        $formVisite->handlerequest($request);
        if ($formVisite -> isSubmitted() && $formVisite->isValid()){
            $this->repository->add($visite);
            return $this->redirectToRoute ('admin.voyages');
        }
        
        return $this ->render("admin/admin.voyages.edit.html.twig",[
            'visite' => $visite,
            'formvisite' => $formVisite -> createview()
        ]);
    }
}

 
