<?php 

include_once "bootstrap.php";

// Add new product
if(isset($_GET['name'])){
    $product = new Product();
    $product->setName($_GET['name']);
    $entityManager->persist($product);
    $entityManager->flush();
    header("Location: /ComposerDemo/");
}

// Delete product
if(isset($_GET['delete'])){
    $user = $entityManager->find('Product', $_GET['delete']);
    $entityManager->remove($user);
    $entityManager->flush();
    header("Location: /ComposerDemo/");
}

// Update
if(isset($_POST['update_name'])){
    $user = $entityManager->find('Product', $_POST['update_id']);
    $user->setName($_POST['update_name']);
    $entityManager->flush();
    header("Location: /ComposerDemo/");
}

print("<pre>Find Product by id: " . "<br>");
$product = $entityManager->find('Product', 4);
print $product->getId() . ' ' . $product->getName();
print("</pre>");

print("<pre>Find Product(s) by other property (name): " . "<br>");
$products = $entityManager->getRepository('Product')->findBy(array('name' => 'Doe'));
print $products[0]->getId() . ' ' . $products[0]->getName();
print("</pre>");

print("<pre>Find all Products: " . "<br>");print("</pre>");
$products = $entityManager->getRepository('Product')->findAll();
print("<table>");
foreach($products as $p)
    print("<tr>" 
            . "<td>" . $p->getId()  . "</td>" 
            . "<td>" . $p->getName() . "</td>" 
            . "<td><a href=\"?delete={$p->getId()}\">DELETE</a></td>" 
            . "<td><a href=\"?updatable={$p->getId()}\">UPDATE</a></td>"
        . "</tr>");
print("</table>"); 

if(isset($_GET['updatable'])){
    $product = $entityManager->find('Product', $_GET['updatable']);
    print("<pre>Update Product: </pre>");
    print("
        <form action=\"\" method=\"POST\">
            <input type=\"hidden\" name=\"update_id\" value=\"{$product->getId()}\">
            <label for=\"name\">Product name: </label><br>
            <input type=\"text\" name=\"update_name\" value=\"{$product->getName()}\"><br>
            <input type=\"submit\" value=\"Submit\">
        </form>
    ");
}

print("<pre>Add new product: " . "</pre>");
?>
<form action="" method="GET">
  <label for="name">Product name: </label><br>
  <input type="text" name="name" value="Doe"><br>
  <input type="submit" value="Submit">
</form> 