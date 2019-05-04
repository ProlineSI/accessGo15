<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        $this->Auth->allow(['logout', 'tokensignin','loginApp','scan']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        return $this->redirect(['controller' => 'etickets','action' => 'getStats']);
        $users = $this->paginate($this->Users);
        $title = 'Lista de Usuarios';
        $this->set(compact('users', 'title'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Usuario modificado con éxito.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Error Intente Nuevamente.'));
        }
        $this->set(compact('user'));
    }

    public function editScanner($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Usuario modificado con éxito.'));

                return $this->redirect(['action' => 'scannersIndex']);
            }
            $this->Flash->error(__('Error Intente Nuevamente.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function login()
    {
    
        if ($this->request->is('post')) {

            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->set('Tu email o contraseña son incorrectos.', ['key' => 'auth', 'element' => 'user_error']);
        }
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    public function home()
    {
        $this->autoRender = false;
        $this->redirect(['controller'=> 'etickets','action' => 'tableCena']);
    }

    public function scannersIndex(){
        $title = 'Cuentas de Escaners';
        $actions = '<div class="pull-right" style = "margin: 5px 10px 0 0;">
                        <div class="btn-group" role="group">
                            <button type="button" class="actions-group-btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                
                                <span class="glyphicon glyphicon-menu-hamburger cog"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <a href="/users/addScanner" class="añadir-invitados">Añadir Escaner</a>
                            </ul>
                        </div>
                    </div>';
        $this->set(compact('title', 'actions'));
    }

    public function getScanners(){
        $this->autoRender = false;
        $this->request->allowMethod(['post','get']);
        $session = $this->request->session();
        $data['user'] = $session->read()['Auth']['User'];
        $scanners = $this->Users->find()->where(['admin' => $data['user']['id']]);;
        $resultJ = json_encode($scanners);
                $this->response->type('json');
                $this->response->body($resultJ);
                return $this->response;
    }
    public function addScanner(){
        $session = $this->request->session();
        $admin['user'] = $session->read()['Auth']['User'];
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data['admin'] = $admin['user']['id'];
            $data['name'] = 'scanner';
            $data['surname'] = 'AccessGo';
            $data['cellphone'] = 123456789;
            $data['role'] = 'scanner';
            $user = $this->Users->patchEntity($user, $data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Escaner guardado correctamente'));

                return $this->redirect(['action' => 'scannersIndex']);
            }
            $this->Flash->error(__('Error, intente nuevamente.'));
        }
        $this->set(compact('user'));
    }

    public function deleteScanner()
    {
        $this->autoRender = false;
        $this->request->allowMethod(['post', 'delete']);
        $data = $this->request->getData();
        $user = $this->Users->get($data['id']);
        if ($this->Users->delete($user)) {
            $resultJ = json_encode(['result' => 'Escaner eliminado correctamente.']);
                $this->response->type('json');
                $this->response->body($resultJ);
                return $this->response;
        } else {
            $resultJ = json_encode(['error' => 'Error en la eliminación de Escaner.']);
                $this->response->type('json');
                $this->response->body($resultJ);
                return $this->response;
        }
    }





    public function scan()
    {
            
        if($this->request->is('post'))
        {
            // OBTENGO LOS DATOS QUE VIENEN POR POST
            $usuario = $this->request->getData('usuario');
            $tokenUsu = $this->request->getData('tokenUsu'); 
            $token = $this->request->getParam('_csrfToken');
            $qr = $this->request->getData('qr');
            $event_id = $this->request->getData('event_id');

            //BUSCO EL USUARIO QUE REALIZO EL SCAN
            $user = $this->Users->find('all')
                    ->where(['username'=>$usuario]);  
            $cuenta = $user->count();

            //SI EL USUARIO EXISTE Y SU TOKEN ES VALIDO
            if($cuenta == 1 && $tokenUsu == $token)
            {
                
              $etickets = new EticketsController();
              $response = $etickets->validateQr($qr,$event_id);
              $this->set([
                'message' => $response['response'],
                'detalle' => $response['detalle'],
                '_serialize' => ['message','detalle']

            ]);
            $this->RequestHandler->renderAs($this, 'json'); 
            }else{
                $this->set([
                    'message' => 'error',
                    'description' => 'Hubo un error al registrar el scan, inicie sesión e intente de nuevo',
                    '_serialize' => ['message','description']

                ]);
                $this->RequestHandler->renderAs($this, 'json');
            }    
        }
    }






    public function loginApp()
    {
        

        //FUNCION QUE REALIZA EL LOGIN, TRAE LA PASS HASHEADA DE LA BASE DE DATOS Y COMPARA CON LA QUE VIENE DE LA APP

        if($this->request->is('post')){
            // OBTENGO LOS DATOS QUE VIENEN POR POST
            
          
            $usuario = $this->request->getData('usuario');
            $password = $this->request->getData('password'); 

        
            $users = $this->Users->find('all')
                   
                    ->where(['username'=>$usuario]);
             
            $cuenta = $users->count();
   
             if($cuenta == 1){ //EXISTE UN REGISTRO CON ESE EMAIL
                
             $user = $users->first();
             $nombreUsu = $user->username;

             //VERIFICO CONTRASEÑAS
             $verifyPass = $user->password;
             $validate = password_verify($password,$verifyPass);
            
                if($validate){ //EXISTE EL USUARIO Y LA CONTRASEÑA
                    $this->loadModel('Events');
                    $evento =$this->Events->find('all')
                                            ->where(['user_id'=>$user->admin])->first();
           
                   $this->set([
                        'message' => 'success',
                        'data' => ['evento' => $evento->name,'eventoId'=>$evento->id,'nombreUsu'=>$nombreUsu],
                        '_serialize' => ['message','data']
                    ]);

                    }else{ 

                        $this->set([
                            'message' => 'error',
                            'detalle' => 'El usuario o la contraseña ingresados son incorrectos',
                            '_serialize' => ['message','detalle']
                        ]);
                   
                    }
                    
             }else
                    { 
                        $this->set([
                            'message' => 'error',
                            'detalle' => 'El usuario no existe',
                            '_serialize' => ['message','detalle']
                        ]);
                       
                    }

                    $this->RequestHandler->renderAs($this, 'json');
            }

        //DEVUELVE EL TOKEN NECESARIO PARA VALIDAR LA PETICION POR POST 
        
            if($this->request->is('get')){
            $token = $this->request->getParam('_csrfToken');
            $this->set([
                'token' => $token,
                '_serialize' => ['token']
            ]);
            $this->RequestHandler->renderAs($this, 'json');
        }
    }




}
