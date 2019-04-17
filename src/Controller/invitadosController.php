<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class InvitadosController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['confirmation']);
    }
    public function confirmation($qr = null){
        $title = 'Confirmar asistencia al evento:';
        if(isset($qr)){
            $this->loadModel('Etickets');
            $eticket = $this->Etickets->find()->where(['qr' => $qr])->first();
            $this->set(compact('title', 'eticket'));
        }
    }
}