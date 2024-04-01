<?php
// src/Controller/SubscriptionsController.php

namespace App\Controller;

use App\Controller\AppController;

class SubscriptionsController extends AppController
{

    public function subscribe($brandId = null)
    {
        $userId = $this->Authentication->getIdentity()->id;

        $existingSubscription = $this->Subscriptions->find()
	        ->where(['user_id' => $userId, 'brand_id' => $brandId])
	        ->first();

	    if ($existingSubscription) {
	        $this->Flash->error('Vous êtes déjà abonné à cette marque.');
	        return $this->redirect(['controller' => 'Brands', 'action' => 'index']);
	    }

        if ($brandId && $this->request->is('post')) {
            $subscription = $this->Subscriptions->newEmptyEntity();
            $subscription->user_id = $userId;
            $subscription->brand_id = $brandId;

            if ($this->Subscriptions->save($subscription)) {
                $this->Flash->success('Vous suivez maintenant cette marque.');
            } else {
                $this->Flash->error('Impossible de suivre cette marque. Veuillez réessayer.');
            }
            return $this->redirect(['controller' => 'Brands', 'action' => 'index']);
        }
    }

    public function unsubscribe($brandId = null) {
	    $userId = $this->Authentication->getIdentity()->id;

	    if ($brandId === null) {
	        //error
	        $this->Flash->error('Identifiant de la marque manquant.');
	        return $this->redirect(['controller' => 'Brands', 'action' => 'index']);
	    }

	    $subscription = $this->Subscriptions->find()
	        ->where(['user_id' => $userId, 'brand_id' => $brandId])
	        ->first();

	    if ($subscription && $this->request->is('post')) {
	        if ($this->Subscriptions->delete($subscription)) {
	            $this->Flash->success('Vous ne suivez plus cette marque.');
	        } else {
	            $this->Flash->error('Une erreur est survenue lors de la suppression de l\'abonnement à la marque.');
	        }
	    } else {
	        $this->Flash->error('Vous ne suivez pas cette marque.');
	    }

	    return $this->redirect(['controller' => 'Brands', 'action' => 'index']);
	}

}
