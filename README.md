ChargifyBundle
==============

This bundle provides integration with Chargify for Symfony 2 bsed on this Library https://github.com/johannez/chargify

## Requires Guzzle
I have used https://github.com/misd-service-development/guzzle-bundle with this bundle to handle the actual HTTP requests.

You also need to add some values to parameters.yml

```
parameters:
    ...
    chargify_active: false
    chargify_domain: https://your-domain.chargify.com
    chargify_apikey: your-api-key
    ...
```

## Usage
The bundle is setup with a chargify service, so in your controller you can use code like this

```
    public function createChargifyAccount($id)
    {
        if ($this->container->getParameter('chargify_active')) {
            $entityManager = $this->getDoctrine()->getManager();

            $person = $entityManager->getRepository('AcmeUserBundle:Person')->find($id);

            if (!$person) {
                throw $this->createNotFoundException('Unable to find Person.');
            }

            $data = array('customer' => array(
                'first_name' => $person->getGivenName(),
                'last_name' => $person->getFamilyName(),
                'email' => $person->getEmail()
            ));

            $customer = $this->get('chargify.customer')->create($data);

            $person->setChargifyId($customer->id);
            $entityManager->flush();

            $this->get('session')->getFlashBag()->add( 'info', 'Person has been created in Chargify.' );
        } else {
            $this->get('session')->getFlashBag()->add( 'info', 'Chargify is disabled at the moment.' );
        }

        return $this->redirect($this->generateUrl('person_show', array('id'=>$id)));
    }
```