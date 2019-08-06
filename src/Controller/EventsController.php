<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Events Controller
 *
 * @property \App\Model\Table\EventsTable $Events
 *
 * @method \App\Model\Entity\Event[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EventsController extends AppController
{

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

    public function importExcelfileCena ($id = null){
        $this->autoRender = false;
        $data = $this->request->getData();
        $file = $data['excel'];
        $excelFile = $file['tmp_name'];
        //echo json_encode($excelFile);
        $helper = new Helper\Sample();
        $inputFileName = $excelFile;
        $spreadsheet = IOFactory::load($inputFileName);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();
        $type = 'cena';
        $event_id = $id;
        $etickets = [];
        $counter = 0;
        $this->loadModel('Etickets');
        for($i = 1; $i < count($sheetData); $i++){
            if($sheetData[$i][0] != null){
                $counter += 1;
            }
        }
        for($i = 1; $i <= $counter; $i++){
            $eticket_data = [
                'qr' => $sheetData[$i][0].$sheetData[$i][1],
                'name' => (string) $sheetData[$i][0],
                'surname' => (string) $sheetData[$i][1],
                'cellphone' => (string) $sheetData[$i][2],
                'confirmation' => 0,
                'scanned' => 0,
                'type' => $type,
                'mesa' => (string) $sheetData[$i][3],
                'quantity' => (string) $sheetData[$i][4],
                'event_id' => $event_id,
                'scanCount' => 0
            ];
            array_push($etickets, $eticket_data);
        }
        $entities_etickets = $this->Etickets->newEntities($etickets);
        if(($etickets = $this->Etickets->saveMany($entities_etickets))){
            //echo json_encode($etickets);die;
            $this->Flash->success(__('Información guardada correctamente'));
            $this->redirect(['controller' => 'Etickets', 'action' => 'tableCena']);
        }else{
            //echo json_encode('no entro');die;
            $this->Flash->error(__('No se pudo leer el excel o tiene algún error. Controle que el archivo tenga en forma correcta los campos, según la información'));
            $this->redirect(['action' => 'editEvent']);
        }
    }
    public function importExcelfileDCena ($id = null){
        $this->autoRender = false;
        $data = $this->request->getData();
        $file = $data['excel'];
        $excelFile = $file['tmp_name'];
        //echo json_encode($excelFile);
        $helper = new Helper\Sample();
        $inputFileName = $excelFile;
        $spreadsheet = IOFactory::load($inputFileName);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();
        $type = 'despuesDeCena';
        $event_id = $id;
        $etickets = [];
        $counter = 0;
        $this->loadModel('Etickets');
        for($i = 1; $i < count($sheetData); $i++){
            if($sheetData[$i][0] != null){
                $counter += 1;
            }
        }
        for($i = 1; $i <= $counter; $i++){
            $new_eticket = $this->Etickets->newEntity();
            $eticket_data = [
                'qr' => $sheetData[$i][0].$sheetData[$i][1],
                'name' => (string) $sheetData[$i][0],
                'surname' => (string) $sheetData[$i][1],
                'cellphone' => (string) $sheetData[$i][2],
                'confirmation' => 0,
                'scanned' => 0,
                'type' => $type,
                'mesa' => (string) $sheetData[$i][3],
                'quantity' => (string) $sheetData[$i][4],
                'event_id' => $event_id,
                'scanCount' => 0
            ];
            $new_eticket = $this->Etickets->patchEntity($new_eticket, $eticket_data);
            array_push($etickets, $new_eticket);
        }
        if(($etickets = $this->Etickets->saveMany($etickets))){
            $this->Flash->success(__('Información guardada correctamente'));
            $this->redirect(['controller' => 'Etickets', 'action' => 'tableDespuesCena']);
        }else{
            $this->Flash->error(__('No se pudo leer el excel o tiene algún error. Controle que el archivo tenga en forma corrercta los campos, según la recomendación'));
            $this->redirect(['action' => 'editEvent']);
        }
    }
    public function downloadModel(){
        $file_path ='guia_modelo.xls';
        $this->response->file($file_path, array(
            'download' => true,
            'name' => 'Modelo Guía.xls',
        ));
        return $this->response;
    }     
}
