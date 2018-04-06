<?php
namespace App\Controller;

use App\Entity\PlayerWanabe;
use App\Repository\PlayerWanabeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class PlayerWanabeConfirmController extends AbstractController
{
    private $mailer;
    private $playerWanabeRepository;

    public function __construct(PlayerWanabeRepository $playerWanabeRepository, \Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
        $this->playerWanabeRepository = $playerWanabeRepository;
    }

    public function confirm(Request $request)
    {
        // The model
        $model = $this->createModel($request);
        if (isset($model['response'])) { return $model['response']; }
    
        $this->sendEmail($model);
        
        // And render
        $tplData = $model;
        $template = $request->get('_template');
        return $this->render($template,$tplData);   
    }
    protected function createModel(Request $request)
    {
        $model = array();

        $playerId = $request->get('id');
        $player   = $this->playerWanabeRepository->find($playerId);
        
        if (!$player)
        {
            $model['response'] = $this->redirectToRoute('cerad_player_wanabe_register');
            return $model;
        }
        
        $model["player"] = $player;
               
        return $model;
    }
    
    private function sendEmail($model)
    {
        $subject = sprintf('[NAFPlayerPool] Player Added');

        /** @var PlayerWanabe $player */
        $player = $model['player'];
        $nameLastPlayer = $player->getNameLastPlayer();
        $nameFirstPlayer = $player->getNameFirstPlayer();
        $gender = $player->getGender();
        $city = $player->getCity();
        $state = $player->getState();
        $phonePlayer = $player->getPhonePlayer();
        $indoorExperience = $player->getIndoorExperience();
        $emailAddress = $player->getEmailAddress();
        $html = <<<EOD
{$nameFirstPlayer} {$nameLastPlayer} just added his name to the player pool.<br>
<br>
Details:<br>
First Name: {$nameFirstPlayer}<br>
Last Name: {$nameLastPlayer}<br>
Gender: {$gender}<br>
Phone: {$phonePlayer}<br>
<br>
Optional Details:<br>
From: {$city}, {$state}<br>
Indoor Experience: {$indoorExperience}<br>
Email: {$emailAddress}
EOD;

        /** @var \Swift_Message $message */
        $message = $this->mailer->createMessage();

        $message->setBody($html,'text/html');

        $message->setSubject($subject);

        // [] is like array('info@nafutsal.org' => 'www.nafutsal.org')
        $message->setFrom(['info@nafutsal.org' => 'www.nafutsal.org']);

        $message->setTo(['registrar@nafutsal.org' => 'Registrar']);
        
        $message->setReplyTo($player->getEmailAddress());

        /**  noinspection PhpParamsInspection */
        $this->mailer->send($message);

    }
}
