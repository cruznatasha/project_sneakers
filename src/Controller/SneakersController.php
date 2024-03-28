<?php   		//src/Controller/SneakersController.php

namespace App\Controller;

Class SneakersController extends AppController{

	public function beforeFilter(\Cake\Event\EventInterface $e){
		parent::beforeFilter($e);

		//liste des actions possibles sans etre connecté 
		$this->Authentication->addUnauthenticatedActions(['index', 'details']); 
	}

	public function index(){
		//on recup tous les enregistrements de couleurs
		$allSneakers = $this->Sneakers->find('all')->contain(['Brands']); 

		//on les transmets a la vue
		$this->set(compact('allSneakers'));
	}

	public function details(int $id = null){
		if(empty($id)){
			$this->Flash->error('Cette paire n\'existe pas');
			return $this->redirect(['action' => 'index']);
		}

		$s = $this->Sneakers->findById($id)->contain(['Brands']);

		//si la requete n'a pas trouvé de résultat
		if($s->isEmpty()){
			$this->Flash->error('Cette paire est introuvable'); 
			//redirection
			return $this->redirect(['action' => 'index']); 
		}

		$s = $s->first();

		$this->set(compact('s')); 
	}

	public function new(){		//
		$userLevel = $this->request->getAttribute('identity')->level; 

		if($userLevel !== 'admin'){
			$this->Flash->error('Vous ne pouvez pas ajouter d\'article');
			return $this->redirect(['controller' => 'Sneakers', 'action' => 'index']); 
		}

		//on crée une entité vide
		$new = $this->Sneakers->newEmptyEntity(); 
		$new = $this->Sneakers->patchEntity($new, $this->request->getData()); 

		$new->user_id = $this->request->getAttribute('identity')->id; 

		//si on a reçu le formulaire (si on est en method post)
		if($this->request->is('post')) : 
			//on recup les données du form et on les place dans l'entité vide
			$new = $this->Sneakers->patchEntity($new, $this->request->getData()); 
			//si l'entité est correcte et qu'on peut sauvegarder l'entité
			if($this->Sneakers->save($new)) : 
				//on crée le message de confirmation
				$this->Flash->success('Paire de sneakers sauvegardée'); 
				//on redigirige
				return $this->redirect(['controller' => 'Sneakers', 'action' => 'index']);
			//fin validation
			endif; 
			//si on arrive ici, c'est qu'on a eu des données et que la sauvegarde a planté. Donc on crée un message d'erreur
			$this->Flash->error('Sauvegarde impossible, veuillez réessayer');

		//fin du form
		endif; 

		//on transmet cette entité à la vue
		$this->set(compact('new')); 
	}

	public function edit(int $id = null){
		//
	}

	public function delete(int $id){
		//
	}
}
