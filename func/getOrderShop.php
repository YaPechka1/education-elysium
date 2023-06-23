<?php 
if (isset($_GET['id'])){
    $id= $_GET['id'];
    include './link.php';
    $query = "SELECT DISTINCT `order`.`id`, DATE_FORMAT(`date`, '%d.%m.%Y') as 'date' FROM `order_item` INNER JOIN `order` on `order`.id=order_item.id_order INNER JOIN items on items.id=order_item.id_item INNER JOIN category on category.id = items.id_category INNER JOIN shops on shops.id = category.id_shop where shops.id=$id;";
    exit(json_encode(mysqli_fetch_all(mysqli_query($link,$query), MYSQLI_ASSOC)));
}
exit(json_encode(''));
?>