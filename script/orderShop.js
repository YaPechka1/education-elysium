let it_container = document.querySelector('.it');
let items =[];
const urlParams = new URLSearchParams(window.location.search);
const myParam = urlParams.get('id');
getOrder();


async function getOrder(){
    await fetch('/func/getOrderShop.php?id='+myParam).then(res=>res.json()).then(
        data=>{
            if (data.length == 0){
                it_container.insertAdjacentHTML('beforeend', '<h4 class="block" style="justify-content: center">Заказов нет</h4>');
            }
            else{
                for (let i=0;i<data.length;i++){
                    it_container.insertAdjacentHTML('beforeend', '<div class="block item"><h5>#' + data[i].id + '</h5><input type="text" class="block" style="text-align:center" readonly value="' + data[i].date + '"><a href="/orderShopOne.php?id=' + data[i].id + '&id_shop='+myParam+'"><button class="btn">Подробнее</button></a></div>')
                }
            }
        }
    )
}