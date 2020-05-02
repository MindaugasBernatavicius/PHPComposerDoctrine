<?php 
include_once "bootstrap.php";

// Helper functions
function redirect_to_root(){
    header("Location: " . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));
}

// Update shippment
if(isset($_POST['update_shipment_details'])){
    $product = $entityManager->find('Product', $_POST['update_id']);
    $product->getShippment()->setShippmentDetails($_POST['update_shipment_details']);
    $entityManager->flush();
    redirect_to_root();
}

print("<pre>Find shippment for specific product: " . "<br>");
$product = $entityManager->find('Product', 1);
print($product->getShippment()->getShippmentDetails());
print(' <a href="?updatable"><button>UPDATE</button></a>');
print("</pre><hr>");

if(isset($_GET['updatable'])){
    print("<pre>Update Shipment: </pre>");
    print("
        <form action=\"\" method=\"POST\">
            <input type=\"hidden\" name=\"update_id\" value=\"{$product->getId()}\">
            <label for=\"name\">Product name: </label><br>
            <input type=\"text\" name=\"update_shipment_details\" value=\"{$product->getShippment()->getShippmentDetails()}\"><br>
            <input type=\"submit\" value=\"Submit\">
        </form>
    ");
    print("<hr>");
}


?>