<?php
namespace Mbates\ChargifyBundle\Model;

class ProductFamilyModel extends AbstractModel
{
    public $name;
    public $handle;
    public $id;
    public $accounting_code;
    public $description;

    public function getName()
    {
        return 'product_family';
    }
}