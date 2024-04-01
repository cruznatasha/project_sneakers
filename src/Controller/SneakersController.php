<?php   		//src/Controller/SneakersController.php

namespace App\Controller;

Class SneakersController extends AppController{

	public function beforeFilter(\Cake\Event\EventInterface $e){
		parent::beforeFilter($e);

		$this->loadModel('Favorites');

		//liste des actions possibles sans etre connecté 
		$this->Authentication->addUnauthenticatedActions(['index', 'details']); 
	}

	public function index(){
		//on recup tous les enregistrements de couleurs
		$allSneakers = $this->Sneakers->find('all')->contain(['Brands']); 

		if ($this->request->getAttribute('identity')) {
	        $userId = $this->Authentication->getIdentity()->id;

	        $favoriteId = $this->Sneakers->Favorites->find()
	            ->where(['user_id' => $userId])
	            ->extract('sneaker_id')
	            ->toList();
	    } else {
	        $favoriteId = [];
	    }

		//on les transmets a la vue
		$this->set(compact('allSneakers', 'favoriteId'));
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

		$userId = $this->Authentication->getIdentity()->id;
	    $favoriteId = $this->Sneakers->Favorites->find()
	        ->where(['user_id' => $userId, 'sneaker_id' => $id])
	        ->first();

		$this->set(compact('s', 'favoriteId'));
	}

	public function new(){		
		$userLevel = $this->request->getAttribute('identity')->level; 

		if($userLevel !== 'admin'){
			$this->Flash->error('Vous ne pouvez pas ajouter de paire');
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

		$brands = $this->Sneakers->Brands->find('list', ['keyField' => 'id', 'valueField' => 'name']);

		//on transmet cette entité à la vue
		$this->set(compact('new', 'brands')); 
	}

	public function edit(int $id = null){
		//si pas d'id dans l'adresse
		if(empty($id)){
			$this->Flash->error('Cette paire n\'existe pas');
			return $this->redirect(['action' => 'index']);
		}

		$s = $this->Sneakers->findById($id)->all();

		//si la ligne n'existe pas dans la base
		if($s->isEmpty()){
			$this->Flash->error('Cette paire est introuvable'); 
			return $this->redirect(['action' => 'index']); 
		}

		//on recup la ligne
		$s = $s->first();

		//si on a reçu le formulaire (si on est en method post, put ou patch)
		if($this->request->is(['post', 'put', 'patch'])) : 

			//on recup les données du form et on les place dans l'entité que l'on avait déjà
			$this->Sneakers->patchEntity($s, $this->request->getData()); 

			//si l'entité est correcte et qu'on peut sauvegarder l'entité
			if($this->Sneakers->save($s)) : 

				//on crée le message de confirmation
				$this->Flash->success('Paire sauvegardée'); 

				//on redigirige
				return $this->redirect(['controller' => 'Sneakers', 'action' => 'index']);

			//fin validation
			endif; 

			//si on arrive ici, c'est qu'on a eu des données et que la sauvegarde a planté. Donc on crée un message d'erreur
			$this->Flash->error('Sauvegarde impossible, veuillez réessayer');

		//fin du form
		endif;

		$brands = $this->Sneakers->Brands->find('list', ['keyField' => 'id', 'valueField' => 'name']);

		$this->set(compact('s', 'brands')); 
	}

	public function delete(int $id = null) {
	    if (empty($id)) {
	        $this->Flash->error('ID de la paire manquant.');
	    } else {
	        $s = $this->Sneakers->get($id);
	        if ($this->Sneakers->delete($s)) {
	            $this->Flash->success('La paire de sneakers a été supprimée.');
	        } else {
	            $this->Flash->error('Impossible de supprimer la paire de sneakers.');
	        }
	    }

	    return $this->redirect(['action' => 'index']);
	}
}
