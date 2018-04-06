<?php
namespace App\Controller;

use App\Entity\Camper;
use App\FormType\CamperRegisterFormType;
use App\Repository\CamperRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class CamperRegisterController extends AbstractController
{
    private $camperRepository;

    public function __construct(CamperRepository $camperRepository)
    {
        $this->camperRepository = $camperRepository;
    }

    public function register(Request $request)
    {
        $model = $this->createModel($request);
        
        $form = $this->createModelForm($model);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {   
            $camper = $model['camper'];

            $this->camperRepository->save($camper);
            $this->camperRepository->commit();
            
            return $this->redirectToRoute('cerad_camper_payment',array('id' => $camper->getId()));
        }
        // And render
        $tplData = array();
        $tplData['form'] = $form->createView();
        $template = $request->get('_template');dump($template);
        return $this->render($template,$tplData);   
    }
    private function createModel(Request $request)
    {
        $camperRepository = $this->camperRepository;
        
        $camper = null;
        $camperId = $request->get('id');
        if ($camperId) {$camper = $camperRepository->find($camperId);}
        
        if (!$camper) {$camper = new Camper();}
        
        $model = array();
        $model['camper'] = $camper;
        
        return $model;
    }
    private function createModelForm($model)
    {
        /** @var Camper $camper */
        $camper = $model['camper'];
        
        $builder = $this->createFormBuilder($model, array('csrf_protection' => false));

        $builder->setMethod('POST');
        $builder->setAction($this->generateUrl('cerad_camper_register',array('id' => $camper->getId())));
        
        $builder->add('camper',CamperRegisterFormType::class, array('label' => false));
        
        $builder->add('register', SubmitType::class, array('label' => 'Next Step'));
        
        return $builder->getForm();
    }
}
