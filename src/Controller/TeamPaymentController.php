<?php
namespace App\Controller;

use App\Repository\TeamRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class TeamPaymentController extends AbstractController
{
    private $teamRepository;

    public function __construct(TeamRepository $teamRepository)
    {
        $this->teamRepository = $teamRepository;
    }

    public function payment(Request $request)
    {
        // The model
        $model = $this->createModel($request);
        if (isset($model['response'])) return $model['response'];
        
        // And render
        $tplData = $model;
        $template = $request->get('_template');
        return $this->render($template,$tplData);   
    }
    protected function createModel(Request $request)
    {
        $model = array();

        $teamId = $request->get('id');
        $team   = $this->teamRepository->find($teamId);
        
        if (!$team)
        {
            $model['response'] = $this->redirectToRoute('cerad_team_register');
            return $model;
        }
        
        // Check if already paid
        $fee = $team->getFee();
        $upLift = ((float)$fee * 0.030999); //divided by 2 to split upLift with team for tournament
        $total = $upLift + (float)$fee;
/*        switch($fee)
        {
            case '395.00': //OLD
                $upLift = '11.81';
                $total = '406.81';
                break;
            
            case '465.00': //OLD
                $upLift = '13.90';
                $total = '478.90';
                break;
            
            case '495.00': //OLD
                $upLift = '14.79';
                $total = '509.79';
                break;
            
            case '555.00': //OLD
                $upLift = '16.59';
                $total = '571.59';
                break;
            
            case '595.00': //OLD
                $upLift = '17.78';
                $total = '612.78';
                break;
        }
 */
        // Ok
        $model['team']   = $team;
        $model['fee']    = $fee;
        $model['upLift'] = sprintf("%.02f",$upLift);
        $model['total']  = sprintf("%.02f",$total);
        
        return $model;
    }
}
