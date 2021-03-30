<?php


/*
Pavyzdys palyginimui kuo skiriasi 1:1 unidirectional ir bidirectional

$product = $entityManager->find('Models\Product', 4);
dump($product);

$shipment = $entityManager->find('Models\Shipment', 1);
dump($shipment);

*/

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="products")
 */
class Product
{
    /** 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;
    /** 
     * @ORM\Column(type="string") 
     */
    protected $name;

    /**
     * One Product has One Shipment.
     * @ORM\OneToOne(targetEntity="Shipments")
     * @ORM\JoinColumn(name="shipment_id", referencedColumnName="id")
     */
    private $shipment;

    /**
     * One product has many features. This is the inverse side.
     * @ORM\OneToMany(targetEntity="Feature", mappedBy="product")
     */
    private $features;

    public function __construct() {
        $this->features = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getShippment()
    {
        return $this->shipment;
    }

    public function setShippment($s)
    {
        $this->shipment = $s;
    }
}

/**
 * @ORM\Entity
 * @ORM\Table(name="shipments")
 */
class Shipments
{
    /** 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /** 
     * @ORM\Column(type="string") 
     */
    protected $shipmentDetails;

    public function setShippmentDetails($details)
    {
        $this->shipmentDetails = $details;
    }

    public function getShippmentDetails()
    {
        return $this->shipmentDetails;
    }
}

/**
 * @ORM\Entity
 * @ORM\Table(name="features")
 */
class Feature
{
    /** 
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * Many features have one product. This is the owning side.
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="features")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    private $product;

    public function getName()
    {
        return $this->name;
    }
}
