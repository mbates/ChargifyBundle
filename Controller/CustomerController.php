<?php
namespace Mbates\ChargifyBundle\Controller;

use Mbates\ChargifyBundle\Model\CustomerModel as Model;

class CustomerController extends AbstractController implements CustomerControllerInterface
{

    /**
     * Return all customers.
     *
     * @return    List of chargify customer objects.
     */
    public function getAll()
    {
        $customers = array();
        // Get the raw data from Chargify.
        $response = $this->request('customers');

        // Convert the raw data into model objects.
        foreach ($response as $data ) {
            if (is_array($data) && is_array($data['customer'])) {
                $customers[] = new Model($data['customer']);
            }
        }

        return $customers;
    }

    /**
     * Returns a chargify customer by ID.
     *
     * @param    $id The numeric id.
     * @return    A chargify customer object.
     */
    public function getById($id)
    {
        $customer = null;

        $response = $this->request('customers/' . $id);

        if (is_array($response) && is_array($response['customer'])) {
            $customer = new Model($response['customer']);
        }

        return $customer;
    }

    /**
     * Returns a chargify customer by reference.
     *
     * @param    $reference The reference string.
     * @return    A chargify customer object.
     */
    public function getByReference($reference)
    {
        $customer = null;

        $response = $this->request('customers/lookup?reference=' . $reference);

        if (is_array($response) && is_array($response['customer'])) {
            $customer = new Model($response['customer']);
        }

        return $customer;
    }

    /**
     * Creates a chargify customer.
     *
     * @param    $data Keyed array of data according to API docs.
     * @return    Newly created chargify object.
     */
    public function create($data)
    {
        $customer = null;

        $response = $this->request('customers', $data, 'POST');

        if (is_array($response) && is_array($response['customer'])) {
            $customer = new Model($response['customer']);
        }

        return $customer;
    }


    /**
     * Updates a chargify customer.
     *
     * @param    $id customer id.
     * @param    $data Keyed array of data according to API docs.
     * @return    Newly created chargify object.
     */
    public function update($id, $data)
    {
        $customer = null;

        $response = $this->request('customers/' . $id, $data, 'PUT');

        if (is_array($response) && is_array($response['customer'])) {
            $customer = new Model($response['customer']);
        }

        return $customer;
    }

}