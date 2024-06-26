<?php   		//src/Controller/ArticlesController.php

namespace App\Controller;

Class ArticlesController extends AppController{

	public function beforeFilter(\Cake\Event\EventInterface $e){
		parent::beforeFilter($e);

		//liste des actions possibles sans etre connecté 
		$this->Authentication->addUnauthenticatedActions(['index', 'details']);
	}

	public function index(){
		//on recup tous les enregistrements de couleurs
		$allArticles = $this->Articles->find('all');

		$articles = $this->paginate($allArticles);  

		//on les transmets a la vue
		$this->set(compact('allArticles'));
	}

	public function details(int $id = null){
		if(empty($id)){
			$this->Flash->error('Cet article n\'existe pas');
			return $this->redirect(['action' => 'index']);
		}

		$a = $this->Articles->findById($id);

		//si la requete n'a pas trouvé de résultat
		if($a->isEmpty()){
			$this->Flash->error('Cet article est introuvable'); 
			//redirection
			return $this->redirect(['action' => 'index']); 
		}

		$a = $a->first();

		$this->set(compact('a'));
	}

	public function new(){
		
		$userLevel = $this->request->getAttribute('identity')->level; 

		if($userLevel !== 'admin'){
			$this->Flash->error('Vous ne pouvez pas ajouter d\'article');
			return $this->redirect(['controller' => 'Sneakers', 'action' => 'index']); 
		}

		//on crée une entité vide
		$new = $this->Articles->newEmptyEntity(); 
		$new = $this->Articles->patchEntity($new, $this->request->getData()); 

		$new->user_id = $this->request->getAttribute('identity')->id; 

		//si on a reçu le formulaire (si on est en method post)
		if($this->request->is('post')) : 
			//on recup les données du form et on les place dans l'entité vide
			$new = $this->Articles->patchEntity($new, $this->request->getData()); 
			//si l'entité est correcte et qu'on peut sauvegarder l'entité
			if($this->Articles->save($new)) : 
				//on crée le message de confirmation
				$this->Flash->success('Article sauvegardé'); 
				//on redigirige
				return $this->redirect(['controller' => 'Articles', 'action' => 'index']);
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
			$this->Flash->error('Cet article n\'existe pas');
			return $this->redirect(['action' => 'index']);
		}

		$a = $this->Articles->findById($id)->all();

		//si la ligne n'existe pas dans la base
		if($a->isEmpty()){
			$this->Flash->error('Cet article est introuvable'); 
			return $this->redirect(['action' => 'index']); 
		}

		//on recup la ligne
		$a = $a->first();

		//si on a reçu le formulaire (si on est en method post, put ou patch)
		if($this->request->is(['post', 'put', 'patch'])) : 

			//on recup les données du form et on les place dans l'entité que l'on avait déjà
			$this->Articles->patchEntity($a, $this->request->getData()); 

			//si l'entité est correcte et qu'on peut sauvegarder l'entité
			if($this->Articles->save($a)) : 

				//on crée le message de confirmation
				$this->Flash->success('Article sauvegardé'); 

				//on redigirige
				return $this->redirect(['controller' => 'Articles', 'action' => 'index']);

			//fin validation
			endif; 

			//si on arrive ici, c'est qu'on a eu des données et que la sauvegarde a planté. Donc on crée un message d'erreur
			$this->Flash->error('Sauvegarde impossible, veuillez réessayer');

		//fin du form
		endif;

		$this->set(compact('a')); 
	}

	public function delete(int $id = null) {
	    if (empty($id)) {
	        $this->Flash->error('ID de l\'article manquant.');
	    } else {
	        $a = $this->Sneakers->get($id);
	        if ($this->Sneakers->delete($a)) {
	            $this->Flash->success('L\'article a été supprimé.');
	        } else {
	            $this->Flash->error('Impossible de supprimer l\'article.');
	        }
	    }

	    return $this->redirect(['action' => 'index']);
	}
}
