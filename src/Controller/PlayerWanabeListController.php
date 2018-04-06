<?php
namespace App\Controller;

use App\Repository\PlayerWanabeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class PlayerWanabeListController extends AbstractController
{
    private $playerWanabeRepository;

    public function __construct(PlayerWanabeRepository $playerWanabeRepository)
    {
        $this->playerWanabeRepository = $playerWanabeRepository;
    }

    public function list(Request $request)
    {
        $showAll = (boolean)$request->query->get('showAll');
        
        $model = array('showAll' => $showAll);
        $form = $this->createSearchForm($model);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $model = $form->getData();
                        
            return $this->redirectToRoute('cerad_player_wanabe_list', array('showAll' => $model['showAll']));
        }

        if ($model['showAll'])
        {
            $players = $this->playerWanabeRepository->findAll();
        }
        else
        {
            $players = $this->playerWanabeRepository->findBy(array('status' => 'Available'));
        }
        
        // And render
        $tplData = array();
        $tplData['players'] = $players;
        $tplData['form'] = $form->createView();
        $template = $request->get('_template');
        return $this->render($template,$tplData);   
    }
    private function createSearchForm($model)
    {
        $builder = $this->createFormBuilder($model, array('csrf_protection' => false));

        $builder->setMethod('POST');
        $builder->setAction($this->generateUrl('cerad_player_wanabe_list'));
        
        $builder->add('showAll',CheckboxType::class, array('label' => 'Show All', 'required' => false));
        
        $builder->add('updateButton', SubmitType::class, array('label' => 'Update List'));
        
        return $builder->getForm();
    }
}
