<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;
use Cake\Event\Event;
/**
 * Photos Controller
 *
 * @property \App\Model\Table\PhotosTable $Photos
 *
 * @method \App\Model\Entity\Photo[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PhotosController extends AppController
{
    
    public function initialize(){
        parent::initialize();
        $this->loadComponent('ImagesUtils', [
          'className'   => env('CLASS_NAME'),
          'key'         => env('AWS_CREDENTIALS_ACCESS_KEY_ID'),
          'secret'      => env('AWS_CREDENTIALS_SECRET_ACCESS_KEY'),
          'bucketName'  => env('BUCKET_NAME'),
          'region'      => env('REGION'),
          'tableName'   => env('TABLE_NAME')
        ]);
      }
    

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $photos = $this->loadModel('Photos');

        $title = "Listado de Imagenes";
        $this->set(compact('photos','title'));
    }

    /**
     * View method
     *
     * @param string|null $id Photo id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view()
    {
        $this->loadModel('Etickets');
        $session = $this->request->session();
        $data['user'] = $session->read()['Auth']['User'];
        //var_dump($data['user']['id']);die;
        $event = $this->Etickets->Events->find('all', [
            'contain' => ['Photos']
        ])->where(['user_id' => $data['user']['id']])->first();
        //var_dump($event['id']);die;

        $event_id = $event['id'];

        if ($this->request->is(['patch', 'post', 'put'])) {
            
            $data = $this->request->getData()['images'];
            $cantImages = (sizeof($data));
            
            for($i = 0; $i < $cantImages;$i++){
                $image = $data[$i];
                if (($image['error']) == 0){
                    
                    $this->add_event($image, $event_id);
                }
            }
            $this->Flash->success(__('Las Imagenes se han guardado con exito.'));
            return $this->redirect(['action' => 'view']);
        }

        $actions = '<div class="pull-right" style = "margin: 5px 10px 0 0;">
                        <div class="btn-group" role="group">
                            <button type="button" class="actions-group-btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                
                                <span class="glyphicon glyphicon-menu-hamburger cog"></span>
                            </button>
                        </div>
                    </div>';

        $title = "Editar Imagenes \"$event->name\"";
        $this->set(compact('event', 'title', 'actions'));
    }

    
    /**
     * Edit method
     *
     * @param string|null $id Photo id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $photo = $this->Photos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $photo = $this->Photos->patchEntity($photo, $this->request->getData());
            if ($this->Photos->save($photo)) {
                $this->Flash->success(__('The photo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The photo could not be saved. Please, try again.'));
        }
        $title = 'Editar Imagen';
        $this->set(compact('photo', 'title'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Photo id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
  

    //METODOS S3


//ADD EVENT
    public function add_event($image = null, $event_id = null)
    {   
        $this->autoRender = false;
        //$this->request->allowMethod(['get']);
        
        $picture['regular'] = $image;
        
        $EventsPhotos = TableRegistry::get('EventsPhotos');
        if ($picture) {
            
            //var_dump($picture);die;
            $photo = $this->ImagesUtils->save($picture, 'images', 600, 400, 200, 200);
            if(!$photo){
                $this->Flash->error(__('La foto no pudo ser guardada en el servidor.'));
                return $this->redirect(['action' => 'view']);
            }
            $post_event = ['event_id'=>$event_id, 'photo_id'=>$photo['id']];
            
            $eventPhoto = $EventsPhotos->newEntity();
            $eventPhoto = $EventsPhotos->patchEntity($eventPhoto, $post_event);
            
            if($EventsPhotos->save($eventPhoto)){
                //$this->Flash->success(__('La foto se gurdo correctamente.'));
            } else {
                $this->Flash->error(__('La foto se guardo en el servidor pero no pudo se vinculada con el evento.'));
            }
        }else{
        $this->Flash->error(__('No se ha adjuntado foto.'));
        }
        //return $this->redirect(['controller'=>'Users', 'action' => 'view',$user_id]);
    }

    public function deleteEvent($id, $event_id)
    {
        $EventsPhotos = TableRegistry::get('EventsPhotos');
        $eventsPhoto = $EventsPhotos->get($id);
        $photo_id = $eventsPhoto['photo_id'];
        if ($EventsPhotos->delete($eventsPhoto)) {
            $Photos = TableRegistry::get('Photos');
            $photo = $Photos->get($photo_id);
                if ($Photos->delete($photo)) {
                    //$this->Flash->success(__('Se elimino la foto'));
                }else{
                    //$this->Flash->error(__('No se pudo eliminar la foto.'));
                }
            $this->Flash->success(__('Se desviculó la imagen del evento.'));
        } else {
            $this->Flash->error(__('No se pudo desvincular la imagen del evento.'));
        }

        return $this->redirect(['controller'=>'Photos', 'action' => 'view']);
    }
    }
