<?php
namespace App\Controller;

use App\Entity\Player;
use App\FormType\PlayerRegisterFormType;
use App\Repository\PlayerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;


class PlayerRegisterController extends AbstractController
{
    private $playerRepository;

    public function __construct(PlayerRepository $playerRepository)
    {
        $this->playerRepository = $playerRepository;
    }

    public function register(Request $request)
    {
        $model = $this->createModel($request);

        $form = $this->createModelForm($model);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {   
            $player = $model['player'];

            $this->playerRepository->save($player);
            $this->playerRepository->commit();
            
            return $this->redirectToRoute('cerad_player_payment',array('id' => $player->getId()));
        }
        // And render
        $tplData = array();
        $tplData['form'] = $form->createView();
        $template = $request->get('_template');
        return $this->render($template,$tplData);   
    }
    private function createModel(Request $request)
    {
        $player = null;
        $playerId = $request->get('id');
        if ($playerId) {$player = $this->playerRepository->find($playerId);}
        
        if (!$player) {$player = $this->playerRepository->createPlayer();}
        
        $model = array();
        $model['player'] = $player;
        
        return $model;
    }
    private function createModelForm($model)
    {
        /** @var Player $player */
        $player = $model['player'];
        
        $builder = $this->createFormBuilder($model, array('csrf_protection' => false));

        $builder->setMethod('POST');
        $builder->setAction($this->generateUrl('cerad_player_register',array('id' => $player->getId())));
        
        $builder->add('player',PlayerRegisterFormType::class, array('label' => false));
        
        $builder->add('register', SubmitType::class, array('label' => 'Next Step'));
        
        return $builder->getForm();
    }
}
