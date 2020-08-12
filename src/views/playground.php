<?php 

    include_once "bootstrap.php";

    // Helper functions
    function redirect_to_root(){
        header("Location: " . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));
    }

    // Add new product
    if(isset($_GET['product_name'])){
        $product = new Product();
        $product->setName($_GET['product_name']);
        $shipment = new Shipments();
        $shipment->setShippmentDetails($_GET['shipment_details']);
        $entityManager->persist($shipment);
        $product->setShippment($shipment);
        $entityManager->persist($product);
        $entityManager->flush();
        redirect_to_root();
    }

    // Add new customer
    if(isset($_GET['customer_name'])){
        $customer = new Customer();
        $customer->setName($_GET['customer_name']);

        $cart = new Cart();
        $cart->setItem($_GET['cart_item']);
        $cart->setCustomer($customer);
        $entityManager->persist($cart);

        // $customer->setCart($cart); // superflous
        $entityManager->persist($customer);
        $entityManager->flush();
        redirect_to_root();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Playground</title>
</head>
<body>
    <h1>Let's play around with unidirectional and bidirectional relations</h1>
    <pre>
In the previous examples we had these entities with the following relations:
- Product   --> Shipment    ; One-To-One, Unidirectional 
- Customer  --> Cart        ; One-To-One, Bidirectional

... let's illustrate the difference between uni- and bi-directionality with them.

0. Can we do $product->setShippment($shipment); + persist() w/o persisting the shipment first?
1. Can we reach shipment from product object?
2. Can we reach product from shipment object?
3. Can we reach cart from customer?
4. Can we reach customer from cart object?

... let's clean up the database and implement those.
    </pre>
    <p style="background-color: lightgray">
    <?php 

    // [TASK] 0. Can we do $product->setShippment($shipment); + persist() w/o persisting the shipment first?
    // [ACTION] Comment out the line: $entityManager->persist($shipment);
    // [RESULT] Fatal error: Uncaught Doctrine\ORM\ORMInvalidArgumentException: A new entity was found through the relationship 'Product#shipment' th
    
    // We don't need to flush, but we need to persist if there is a relation
    // We can also add @ManyToOne(..,cascade={"persist"}) as the error specifies

    // [TASK] 1. Can we reach shipment from product object?
    // [ACTION] 

    // print($entityManager->find('Product', 1)->getName() . '<br>');
    // print($entityManager->find('Shipments', 1)->getShippmentDetails() . '<br>');
    // print($entityManager->find('Product', 1)->getShippment()->getShippmentDetails() . '<br>');

    // [RESULT] Yes, we can reach shipment from product object.

    // [TASK] 2. Can we reach shipment from product object?
    // [ACTION] Nothing we can do, unless change the relation type

    // [TASK] 3. Can we reach cart from customer?
    // [ACTION] 

    print($entityManager->find('Customer', 7)->getName() . '<br>');
    print($entityManager->find('Customer', 7)->getCart()->getItem() . '<br>');

    // [RESULT] Yes, we can reach cart from customer object.

    // [TASK] 4. Can we reach customer from cart object?
    // [ACTION] 

    print($entityManager->find('Cart', 8)->getItem() . '<br>');
    print($entityManager->find('Cart', 8)->getCustomer()->getName() . '<br>');

    // [RESULT] Yes, we cat reach customer from cart object! That is the magic!
    
    ?>
    </p>
    <h3>Create new product and shipment</h3>
    <form action="" method="GET">
        <label for="name">Product name: </label><br>
        <input type="text" name="product_name" value="Product Name"><br>
        <label for="name">Shipment details: </label><br>
        <input type="text" name="shipment_details" value="Shipment Details"><br>
        <input type="submit" value="Submit">
    </form>

    <h3>Create new Customer and cart</h3>
    <form action="" method="GET">
        <label for="name">Customer name: </label><br>
        <input type="text" name="customer_name" value="Customer name"><br>
        <label for="name">Cart item: </label><br>
        <input type="text" name="cart_item" value="Cart item"><br>
        <input type="submit" value="Submit">
    </form>  
</body>
</html>