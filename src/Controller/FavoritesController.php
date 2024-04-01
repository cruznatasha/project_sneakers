<?php
// src/Controller/FavoritesController.php

namespace App\Controller;

use App\Controller\AppController;

class FavoritesController extends AppController
{

    public function add($sneakerId = null)
    {
        $userId = $this->Authentication->getIdentity()->id;

        $existingFavorite = $this->Favorites->find()
	        ->where(['user_id' => $userId, 'sneaker_id' => $sneakerId])
	        ->first();

	    if ($existingFavorite) {
	        $this->Flash->error('Cette paire est déjà dans vos favoris.');
	        return $this->redirect(['controller' => 'Sneakers', 'action' => 'index']);
	    }

        if ($sneakerId && $this->request->is('post')) {
            $favorite = $this->Favorites->newEmptyEntity();
            $favorite->user_id = $userId;
            $favorite->sneaker_id = $sneakerId;

            if ($this->Favorites->save($favorite)) {
                $this->Flash->success('Cette paire est désormais dans vos favoris');
            } else {
                $this->Flash->error('Impossible de mettre cette paire en favoris. Veuillez réessayer.');
            }
            return $this->redirect(['controller' => 'Sneakers', 'action' => 'index']);
        }
    }

    public function remove($sneakerId = null) {

        $userId = $this->Authentication->getIdentity()->id;

        $favorite = $this->Favorites->find()
            ->where(['user_id' => $userId, 'sneaker_id' => $sneakerId])
            ->first();

        if ($favorite) {
            if ($this->Favorites->delete($favorite)) {
                $this->Flash->success('Cette paire n\'est plus dans vos favoris');
            } else {
                $this->Flash->error('Une erreur est survenue lors de la suppression du favori');
            }
        } else {
            $this->Flash->error('La paire n\'est pas dans vos favoris');
        }

        return $this->redirect(['controller' => 'Sneakers', 'action' => 'index']);
    }
}
