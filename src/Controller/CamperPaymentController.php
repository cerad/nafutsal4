<?php
namespace App\Controller;

use App\Repository\CamperRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CamperPaymentController extends AbstractController
{
    private $camperRepository;

    public function __construct(CamperRepository $camperRepository)
    {
        $this->camperRepository = $camperRepository;
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
        
        $camperRepo = $this->camperRepository;
        
        $camperId = $request->get('id');
        $camper   = $camperRepo->find($camperId);
        
        if (!$camper)
        {
            $model['response'] = $this->redirect('cerad_camper_register');
            return $model;
        }
        
        // Check if already paid
        $fee = $camper->getFee();
        $upLift = ((float)$fee * 0.030999);
        $total = $upLift + (float)$fee;
/*        switch($fee)
        {
            case '9.75':
                $upLift = '0.29';
                $total = '10.04';
                break;           
            
            case '28.00':
                $upLift = '0.84';
                $total = '28.84';
                break;           
            
            default:
                $upLift = '2.99';
                $total = '102.99';
                break;           
        }
*/        // Ok
        $model['camper']   = $camper;
        $model['fee']    = $fee;
        $model['upLift'] = $upLift;
        $model['total']  = $total;
        
        return $model;
    }
}
