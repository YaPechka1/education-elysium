let shopDOM = document.querySelector('.grid44');
getShop();
async function getShop(){
    await fetch('/func/getShop.php').then(res=>res.json()).then(
        data=>{
            shops=data;
            drawShops();
        }
    )
}
function drawShops(){
    shopDOM.innerHTML='';
    for (let i=0;i<shops.length;i++){
        shopDOM.insertAdjacentHTML('beforeend', '<div id="'+shops[i].id+'" class="block item"><h5>'+shops[i].name+'</h5><img src="'+shops[i].logo+'"><input type=text readonly class="block" value="'+shops[i].floor+' этаж"><a href="/one-shop.php?id='+shops[i].id+'"><button class="btn">Подробнее</button></a></div>');
    }
    
}