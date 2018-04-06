<?php
namespace App\Controller;

use App\Entity\Team;
use App\FormType\TeamRegisterFormType;
use App\Repository\TeamRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;


class TeamRegisterController extends AbstractController
{
    private $teamRepository;

    public function __construct(TeamRepository $teamRepository)
    {
        $this->teamRepository = $teamRepository;
    }
    public function register(Request $request)
    {
        $model = $this->createModel($request);
        
        $form = $this->createModelForm($model);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {   
            $team = $model['team'];

            $this->teamRepository->save($team);
            $this->teamRepository->commit();
            
            return $this->redirectToRoute('cerad_team_payment',array('id' => $team->getId()));
        }
        // And render
        $tplData = array();
        $tplData['form'] = $form->createView();
        $template = $request->get('_template');
        return $this->render($template,$tplData);   
    }
    protected function createModel(Request $request)
    {
        $team = null;
        $teamId = $request->get('id');
        if ($teamId) $team = $this->teamRepository->find($teamId);
        
        if (!$team) $team = $this->teamRepository->createTeam();
        
        $model = array();
        $model['team'] = $team;
        
        return $model;
    }
    protected function createModelForm($model)
    {
        /** @var Team $team */
        $team = $model['team'];
        
        $builder = $this->createFormBuilder($model, array('csrf_protection' => false));

        $builder->setMethod('POST');
        $builder->setAction($this->generateUrl('cerad_team_register',array('id' => $team->getId())));
        
        $builder->add('team',TeamRegisterFormType::class, array('label' => false));
        
        $builder->add('register', SubmitType::class, array('label' => 'Next Step'));
        
        return $builder->getForm();
    }
}
