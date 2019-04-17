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

    }
}