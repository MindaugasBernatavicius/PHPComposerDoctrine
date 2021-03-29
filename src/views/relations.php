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
    if(isset($_GET['shipment_details'])){
        $shipment = new Shipments();
        $shipment->setShippmentDetails($_GET['shipment_details']);
        $entityManager->persist($shipment);
        $product->setShippment($shipment);
    }
    $entityManager->persist($product);
    $entityManager->flush();
    redirect_to_root();
}

// Update shippment
if(isset($_POST['update_shipment_details'])){
    // $product = $entityManager->find('Models\Product', $_POST['update_id']);
    // $product->getShippment()->setShippmentDetails($_POST['update_shipment_details']);

    $shipment = $entityManager->find('Models\Shipment', $_POST['update_id']);
    $shipment->setShippmentDetails($_POST['update_shipment_details']);

    $entityManager->flush();
    redirect_to_root();
}

print("<pre>Find shippment for specific product (choose product with shipment): " . "<br>");
$product = $entityManager->find('Models\Product', 4);
if($product){
    print($product->getName());
    $shipment = $product->getShippment();
    if($shipment) print(" | " . $shipment->getShippmentDetails() . " | ");
    print(' <a href="?updatable"><button>UPDATE</button></a>');
}
print("</pre><hr>");

if(isset($_GET['updatable'])){
    print("<pre>Update Shipment: </pre>");
    print("
        <form action=\"\" method=\"POST\">
            <!-- <input type=\"hidden\" name=\"update_id\" value=\"{$product->getId()}\"> -->
            <input type=\"hidden\" name=\"update_id\" value=\"{$product->getShippment()->getId()}\">
            <label for=\"name\">Product name: </label><br>
            <input type=\"text\" name=\"update_shipment_details\" value=\"{$product->getShippment()->getShippmentDetails()}\"><br>
            <input type=\"submit\" value=\"Submit\">
        </form>
    ");
    print("<hr>");
}

?>
<form action="" method="GET">
  <label for="name">Product name: </label><br>
  <input type="text" name="product_name" value="Product Name 1"><br>
  <label for="name">Shipment details: </label><br>
  <input type="text" name="shipment_details" value="Shipment 1"><br>
  <input type="submit" value="Submit">
</form> 
<hr>
