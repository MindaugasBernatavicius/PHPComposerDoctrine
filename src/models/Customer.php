<?php
use Doctrine\ORM\Mapping as ORM;


/*
Demo kodas:

include_once "bootstrap.php";

$customer = $entityManager->find('Models\Customer', 2);
dump($customer->getCart());

$cart = $entityManager->find('Models\Cart', 2);
dump($cart->getCustomer());

*/

/**
 * @ORM\Entity
 * @ORM\Table(name="customers")
 */
class Customer
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
     * One Customer has One Cart.
     * @ORM\OneToOne(targetEntity="Cart", mappedBy="customer")
     */
    private $cart;

    public function getName()
    {
        return $this->name;
    }

    public function getCart()
    {
        return $this->cart;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setCart($cart)
    {
        $this->cart = $cart;
    }
}

/**
 * @ORM\Entity
 * @ORM\Table(name="carts")
 */
class Cart
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
    protected $item;

    /**
     * One Cart has One Customer.
     * @ORM\OneToOne(targetEntity="Customer", inversedBy="cart")
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
     */
    private $customer;

    public function setItem($item)
    {
        $this->item = $item;
    }

    public function getItem()
    {
        return $this->item;
    }

    public function setCustomer($customer)
    {
        $this->customer = $customer;
    }

    public function getCustomer()
    {
        return $this->customer;
    }
}
