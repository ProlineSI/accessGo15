<?php
namespace App\Controller;

use Cake\Event\Event;
use App\Controller\AppController;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Cake\ORM\TableRegistry;
use App\Model\Table\Events; // <—My model
use Cake\Datasource\ConnectionManager;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Helper;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
require ROOT.DS.'vendor' .DS. 'phpoffice/phpspreadsheet/src/Bootstrap.php';

/**
 * Events Controller
 *
 * @property \App\Model\Table\EventsTable $Events
 *
 * @method \App\Model\Entity\Event[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EventsController extends AppController
{

    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $session = $this->request->session();   
        $data['user'] = $session->read()['Auth']['User'];
        $event = $this->Events->find()->where(['user_id' => $data['user']['id']])->first();
        $fecha_event = $event->endTime;
        $fecha_event = $fecha_event->format('Y-m-d H:i:s');
        $fecha_event = new \DateTime($fecha_event);
        $fecha_event->add(new \DateInterval('P1D'));
        $fecha_event = strtotime($fecha_event->format('Y-m-d H:i:s'));
        $dateTimeZone =  new \DateTimeZone('America/Argentina/Buenos_Aires');
        $today = (new \DateTime('now', $dateTimeZone));
        $today = strtotime($today->format('Y-m-d H:i:s'));
        if($this->Auth->user() && ($today >= $fecha_event) && !($this->request->action === 'finishedEvent')){
            return $this->redirect(['controller' => 'Events', 'action' => 'finishedEvent']);
        }
    }

    public function editEvent()
    {
        $session = $this->request->session();
        $data['user'] = $session->read()['Auth']['User'];
        $event = $this->Events->find()->where(['user_id' => $data['user']['id']])->first();
        $event = $this->Events->get($event->id, [
            'contain' => []
        ]);
        
        $title = "Configuración del Evento";
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $event['wp_msg'] = $data['wp_msg'];
            $event['cena_time'] = $data['cena_time']['hour'].':'. $data['cena_time']['minute'];
            $event['despCena_time'] = $data['despCena_time']['hour'].':'. $data['despCena_time']['minute'];
            if ($this->Events->save($event)) {
                $this->Flash->success(__('Configuración guardada correctamente.'));

                return $this->redirect(['action' => 'editEvent']);
            }
            $this->Flash->error(__('Error al guardar la configuración. Intente nuevamente.'));
        }
        
        $this->set(compact('event', 'title'));
    }
    //public function importExcelfile (){
    //    $helper = new Helper\Sample();
    //    $inputFileName = WWW_ROOT . 'Planilla Invitados a Cena Lourdes Gramajo.xls';
    //    $spreadsheet = IOFactory::load($inputFileName);
    //    $sheetData = $spreadsheet->getActiveSheet()->toArray();
    //    var_dump($sheetData[8]);
    //    die();
    //}
    public function finishedEvent(){
        $title = 'Evento Terminado';
        $session = $this->request->session();   
        $data['user'] = $session->read()['Auth']['User'];
        $event = $this->Events->find()->where(['user_id' => $data['user']['id']])->first();
        $this->set(compact('title', 'event'));
    }
}
