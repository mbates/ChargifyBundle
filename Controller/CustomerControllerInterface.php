<?php
namespace Mbates\ChargifyBundle\Controller;

use Mbates\ChargifyBundle\Model\CustomerModel as Model;

interface CustomerControllerInterface extends AbstractControllerInterface
{

    /**
     * Return all customers.
     *
     * @return    List of chargify customer objects.
     */
    public function getAll();

    /**
     * Returns a chargify customer by ID.
     *
     * @param    $id The numeric id.
     * @return    A chargify customer object.
     */
    public function getById($id);

    /**
     * Returns a chargify customer by reference.
     *
     * @param    $reference The reference string.
     * @return    A chargify customer object.
     */
    public function getByReference($reference);

    /**
     * Creates a chargify customer.
     *
     * @param    $data Keyed array of data according to API docs.
     * @return    Newly created chargify object.
     */
    public function create($data);


    /**
     * Updates a chargify customer.
     *
     * @param    $id customer id.
     * @param    $data Keyed array of data according to API docs.
     * @return    Newly created chargify object.
     */
    public function update($id, $data);

}