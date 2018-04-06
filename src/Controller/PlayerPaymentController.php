<?php
namespace App\Controller;

use App\Repository\PlayerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class PlayerPaymentController extends AbstractController
{
    private $playerRepository;

    public function __construct(PlayerRepository $playerRepository)
    {
        $this->playerRepository = $playerRepository;
    }

    public function payment(Request $request)
    {
        // The model
        $model = $this->createModel($request);
        if (isset($model['response'])) { return $model['response']; }
        
        // And render
        $tplData = $model;
        $template = $request->get('_template');
        return $this->render($template,$tplData);   
    }
    protected function createModel(Request $request)
    {
        $model = array();

        $playerId = $request->get('id');
        $player   = $this->playerRepository->find($playerId);
        
        if (!$player)
        {
            $model['response'] = $this->redirectToRoute('cerad_player_register');
            return $model;
        }
        
        // Check if already paid
        $fee = $player->getFee();
        $USFFplayerFee = $player->getAnnualUSFFplayerFee();
        $upLift = ((float)$fee + (float)$USFFplayerFee)* (0.030999 / 2); // splitting fee between player and league
        $total = $upLift + (float)$fee + (float)$USFFplayerFee;
/*        switch($fee)
        {
            case '28.00':
                $upLift = '0.84';
                $total = '28.84';
                break;           
            
            case '38.00':
                $upLift = '1.14';
                $total = '39.14';
                break;           
            
            default:
                $upLift = '2.99';
                $total = '102.99';
                break;           
            }
 */
        // Ok
        $model['player']   = $player;
        $model['fee']    = $fee;
        $model['upLift'] = sprintf("%.02f",$upLift);
        $model['total']  = sprintf("%.02f",$total);
        
        return $model;
    }
}
