<?php   		//src/Controller/UsersController.php

namespace App\Controller;

Class UsersController extends AppController{

	public function beforeFilter(\Cake\Event\EventInterface $event){
	    parent::beforeFilter($event);
	    // Configure the login action to not require authentication, preventing
	    // the infinite redirect loop issue
	    $this->Authentication->addUnauthenticatedActions(['login']);
	    $this->Authentication->addUnauthenticatedActions(['login', 'signup']);
	}

	public function login(){
		$user = $this->Users->newEmptyEntity(); 

		if ($this->request->is('post')) {
			$result = $this->Authentication->getResult();
		    // If the user is logged in send them away.
		    if ($result->isValid()) {
		        $target = $this->Authentication->getLoginRedirect() ?? '/';
		        $this->Flash->success('Hello again !');
	        	return $this->redirect($target);
	    	}
	        $this->Flash->error('Invalid username or password');
	    }

		$this->set(compact('user')); 
	}

	public function signup(){
		//on crée une entité vide
		$user = $this->Users->newEmptyEntity();

		//si on a reçu le formulaire (si on est en method post)
		if($this->request->is('post')) : 
			//on recup les données du form et on les place dans l'entité vide
			$user = $this->Users->patchEntity($user, $this->request->getData());

			$user->level = 'user'; 
			/*$user->set('level', 'user'); // Par défaut 'user'
	        if ($user->get('level') !== 'user' && $user->get('level') !== 'admin') {
	            $this->Flash->error('Invalid user level. Please, try again with "user" or "admin".');
	            return;
	        }*/
			//si l'entité est correcte et qu'on peut sauvegarder l'entité
			if($this->Users->save($user)) : 
				//on crée le message de confirmation
				$this->Flash->success('The user has been saved.'); 
				//on redigirige
				return $this->redirect(['action' => 'login']);
			//fin validation
			endif; 
			//si on arrive ici, c'est qu'on a eu des données et que la sauvegarde a planté. Donc on crée un message d'erreur
			$this->Flash->error('The user could not be saved. Please, try again.');

		//fin du form
		endif; 

		//on transmet cette entité à la vue
		$this->set(compact('user')); 
	}
 
	public function logout() {
	    $result = $this->Authentication->getResult();
	    // regardless of POST or GET, redirect if user is logged in
	    if ($result && $result->isValid()) {
	        $this->Authentication->logout();
	        return $this->redirect(['controller' => 'Users', 'action' => 'login']);
	    }
	}
}