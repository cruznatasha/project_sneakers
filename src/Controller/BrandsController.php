<?php   		//src/Controller/BrandsController.php

namespace App\Controller;

Class BrandsController extends AppController{

	public function beforeFilter(\Cake\Event\EventInterface $e){
		parent::beforeFilter($e);

		//liste des actions possibles sans etre connecté 
		$this->Authentication->addUnauthenticatedActions(['index', 'details']);
	}

	public function index(){
		//on recup tous les enregistrements de sneakers
		$allBrands = $this->Brands->find('all')->contain('Sneakers');

		$brands = $this->paginate($allBrands);  

		//on les transmets a la vue
		$this->set(compact('allBrands'));
	}

	public function details(int $id = null){
		if(empty($id)){
			$this->Flash->error('Cette marque n\'existe pas');
			return $this->redirect(['action' => 'index']);
		}

		$b = $this->Brands->findById($id)->contain(['Sneakers']);

		//si la requete n'a pas trouvé de résultat
		if($b->isEmpty()){
			$this->Flash->error('Cette marque est introuvable'); 
			//redirection
			return $this->redirect(['action' => 'index']); 
		} 

		$b = $b->first();

		$userId = $this->Authentication->getIdentity()->id;
	    $subscription = $this->Brands->Subscriptions->find()
	        ->where(['user_id' => $userId, 'brand_id' => $id])
	        ->first();

		$this->set(compact('b', 'subscription'));
	}

	public function new(){
		$userLevel = $this->request->getAttribute('identity')->level; 

		if($userLevel !== 'admin'){
			$this->Flash->error('Vous ne pouvez pas ajouter de marque');
			return $this->redirect(['controller' => 'Sneakers', 'action' => 'index']); 
		}

		//on crée une entité vide
		$new = $this->Brands->newEmptyEntity(); 
		$new = $this->Brands->patchEntity($new, $this->request->getData()); 

		$new->user_id = $this->request->getAttribute('identity')->id; 

		//si on a reçu le formulaire (si on est en method post)
		if($this->request->is('post')) : 
			//on recup les données du form et on les place dans l'entité vide
			$new = $this->Brands->patchEntity($new, $this->request->getData()); 
			//si l'entité est correcte et qu'on peut sauvegarder l'entité
			if($this->Brands->save($new)) : 
				//on crée le message de confirmation
				$this->Flash->success('Marque sauvegardée'); 
				//on redigirige
				return $this->redirect(['controller' => 'Brands', 'action' => 'index']);
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
		//si pas d'id dans l'adresse
		if(empty($id)){
			$this->Flash->error('Cette marque n\'existe pas');
			return $this->redirect(['action' => 'index']);
		}

		$b = $this->Brands->findById($id)->all();

		//si la ligne n'existe pas dans la base
		if($b->isEmpty()){
			$this->Flash->error('Cette marque est introuvable'); 
			return $this->redirect(['action' => 'index']); 
		}

		//on recup la ligne
		$b = $b->first();

		//si on a reçu le formulaire (si on est en method post, put ou patch)
		if($this->request->is(['post', 'put', 'patch'])) : 

			//on recup les données du form et on les place dans l'entité que l'on avait déjà
			$this->Brands->patchEntity($b, $this->request->getData()); 

			//si l'entité est correcte et qu'on peut sauvegarder l'entité
			if($this->Brands->save($b)) : 

				//on crée le message de confirmation
				$this->Flash->success('Marque sauvegardée'); 

				//on redigirige
				return $this->redirect(['controller' => 'Brands', 'action' => 'index']);

			//fin validation
			endif; 

			//si on arrive ici, c'est qu'on a eu des données et que la sauvegarde a planté. Donc on crée un message d'erreur
			$this->Flash->error('Sauvegarde impossible, veuillez réessayer');

		//fin du form
		endif;

		$this->set(compact('b')); 
	}

	public function delete(int $id = null) {
	    if (empty($id)) {
	        $this->Flash->error('ID de la marque.');
	    } else {
	        $b = $this->Sneakers->get($id);
	        if ($this->Sneakers->delete($b)) {
	            $this->Flash->success('La marque a été supprimée.');
	        } else {
	            $this->Flash->error('Impossible de supprimer la marque.');
	        }
	    }

	    return $this->redirect(['action' => 'index']);
	}
}
