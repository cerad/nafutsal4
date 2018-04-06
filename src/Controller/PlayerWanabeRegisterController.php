<?php
namespace App\Controller;

use App\Entity\PlayerWanabe;
use App\FormType\PlayerWanabeRegisterFormType;
use App\Repository\PlayerWanabeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;


class PlayerWanabeRegisterController extends AbstractController
{
    private $playerWanabeRepository;

    public function __construct(PlayerWanabeRepository $playerWanabeRepository)
    {
        $this->playerWanabeRepository = $playerWanabeRepository;
    }

    public function register(Request $request)
    {
        $model = $this->createModel($request);
        
        $form = $this->createModelForm($model);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {   
            $player = $model['player'];

            $this->playerWanabeRepository->save($player);
            $this->playerWanabeRepository->commit();
            
            return $this->redirectToRoute('cerad_player_wanabe_confirm',array('id' => $player->getId()));
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
        if ($playerId) {$player = $this->playerWanabeRepository->find($playerId);}
        
        if (!$player) {$player = $this->playerWanabeRepository->createPlayer();}
        
        $model = array();
        $model['player'] = $player;
        
        return $model;
    }
    protected function createModelForm($model)
    {
        /** @var PlayerWanabe $player */
        $player = $model['player'];
        
        $builder = $this->createFormBuilder($model, array('csrf_protection' => false));

        $builder->setMethod('POST');
        $builder->setAction($this->generateUrl('cerad_player_wanabe_register',array('id' => $player->getId())));
        
        $builder->add('player',PlayerWanabeRegisterFormType::class, array('label' => false));
        
        $builder->add('register', SubmitType::class, array('label' => 'Submit'));
        
        return $builder->getForm();
    }
}
