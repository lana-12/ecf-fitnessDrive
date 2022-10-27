<?php

namespace App\Controller;

use App\Entity\Partner;
use App\Entity\Structure;
use App\Repository\PartnerRepository;
use App\Repository\StructureRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin')]

class AdminController extends AbstractController
{
    /**
     * HomePage for Administrator 
     * 
     * @return list partner + count partner+structure
     */
    #[Route('/', name: 'app_admin')]
    
    public function index(PartnerRepository $partnerRepo, StructureRepository $structureRepo, Request $request, ManagerRegistry $doctrine ) : Response
    {
        //Methode avec PartnerRepository => recup tt les partners
        $partners = $partnerRepo->findAllPartners();
        //Methode avec StructureRepository => recup tt les structures
        $structures = $structureRepo->findAllStructures();

        // display how many partners
        $countPartners = $partnerRepo->countPartners();
        // display how many structures
        $countStructures = count($structures);

        return $this->render('admin/index.html.twig',[
            'titleIndex'=> 'Listes des Franchises',
            'countPartners'=> $countPartners,
            'countStructures'=> $countStructures,
            'partners'=> $partners,
            'structures'=>$structures,
            'partners'=> $partnerRepo->getPaginatedPartner((int) $request->query->get("page")),
        ]);
    }

    /**
     * Detail partner
     */
    #[Route('/showpartner/{id<\d+>}', name: 'show-partner')]
    public function showPartner(ManagerRegistry $doctrine, int $id, StructureRepository $structureRepo) : Response
    {
        $repository = $doctrine->getRepository(Partner::class);
        $partner = $repository->find($id);
        
        //display the structures from partner
        $structures = $structureRepo->findAllStructuresByPartner($id);
        dump($structures);

            return $this->render('admin/partner/showpartner.html.twig',[
                'partner'=> $partner,
                'structures'=> $structures,
            ]);        

    }

    /**
     * Detail structure
     */
    #[Route('/showstructure/{id<\d+>}', name: 'show-structure')]
    public function showStructure(ManagerRegistry $doctrine, int $id) : Response
    {
        $repository = $doctrine->getRepository(Structure::class);
        $structure = $repository->find($id);

        $permissions = $structure->getPermissions();

        return $this->render('admin/structure/showstructure.html.twig',[
            'structure'=> $structure,
            'permissions' => $permissions,

        ]);

    }
    
}