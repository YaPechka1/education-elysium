<?php 
session_start();

if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['logo']) && isset($_POST['cat']) && isset($_POST['count_current']) && isset($_POST['count']) && isset($_POST['id_shop']) && isset($_POST['price'])){
    include './link.php';
    $query = "SELECT `name` from `category` where id=".$_POST['cat'];
    $cat_name = mysqli_fetch_all(mysqli_query($link,$query),MYSQLI_ASSOC)[0]['name'];
    $query="SELECT `name` from `shops` where id=".$_POST['id_shop'];

    $shop_name = mysqli_fetch_all(mysqli_query($link,$query),MYSQLI_ASSOC)[0]['name'];
    $item = [
        'id'=>$_POST['id'],
        'name'=>$_POST['name'],
        'logo'=>$_POST['logo'],
        'cat'=>$_POST['cat'],
        'cat_name'=>$cat_name,
        'count_current'=>$_POST['count_current'],
        'count'=>$_POST['count'],
        'id_shop'=>$_POST['id_shop'],
        'shop'=>$shop_name,
        'price'=>$_POST['price'],
    ];
    $x=true;
    for ($i=0;$i<count($_SESSION['cart']);$i++){
        if ($_SESSION['cart'][$i]['id']==$item['id']){
            $_SESSION['cart'][$i]['count_current']=$item['count_current'];
            $x=false;
        }
    }

    if ($x) array_push($_SESSION['cart'],$item);
    exit(json_encode('OK'));
}
exit(json_encode('FAIL'));
?>