<?php
session_start();
if (isset($_GET['id'])){
    $id=$_GET['id'];
    include './link.php';
    $query="SELECT `order_item`.`id`, `id_order`, `id_item`, `status`, order_item.`price`, order_item.`count`, items.logo, items.name as 'item_name', category.name as 'cat_name', shops.name as 'shop_name' FROM `order_item` INNER JOIN items on items.id = order_item.id_item INNER JOIN category on items.id_category = category.id INNER JOIN shops on shops.id = category.id_shop WHERE id_order=$id";
    exit(json_encode(mysqli_fetch_all(mysqli_query($link,$query),MYSQLI_ASSOC)));
}
exit(json_encode(''));

?>
