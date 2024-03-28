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

		$this->set(compact('b'));
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
		//
	}

	public function delete(int $id){
		//
	}
}
