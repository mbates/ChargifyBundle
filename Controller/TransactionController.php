<?php
namespace Mbates\ChargifyBundle\Controller;

use Mbates\ChargifyBundle\Model\TransactionModel as Model;

class TransactionController extends AbstractController
{

    /**
     * Return all transactions.
     *
     * @return    List of chargify transaction objects.
     */
    public function getAll()
    {
        $transactions = array();
        // Get the raw data from Chargify.
        $response = $this->request('transactions');

        // Convert the raw data into model objects.
        foreach ($response as $data ) {
            if (is_array($data) && is_array($data['transaction'])) {
                $transactions[] = new Model($data['transaction']);
            }
        }

        return $transactions;
    }

    /**
     * Returns a chargify transaction by ID.
     *
     * @param    $id The numeric id.
     * @return    A chargify transaction object.
     */
    public function getById($id)
    {
        $transaction = null;

        $response = $this->request('transactions/' . $id);

        if (is_array($response) && is_array($response['transaction'])) {
            $transaction = new Model($response['transaction']);
        }

        return $transaction;
    }

    /**
     * Get all transactions for a specific subscription.
     *
     * @param    $id The numeric subscription id.
     * @return    List of chargify product objects.
     */
    public function getBySubscription($id)
    {
        $transactions = array();

        $response = $this->request('subscriptions/' . $id . '/transactions');

        foreach ($response as $data ) {
            if (is_array($data) && is_array($data['transaction'])) {
                $transactions[] = new Model($data['transaction']);
            }
        }

        return $transactions;
    }

}