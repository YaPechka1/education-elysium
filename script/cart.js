let it_container = document.querySelector('.it');
let items =[];
getItems();
async function getItems() {
    
        await fetch('/func/getCart.php').then(res => res.json()).then(
            async (data) => {
                items = data;
                for (let i = 0; i < data.length; i++) {

                    it_container.insertAdjacentHTML('beforeend', '<div class="block item"><h5>' + data[i].name + '</h5><img src="' + data[i].logo + '"><input type="text" class="block" readonly value="' + data[i].cat_name + '"><input type="number" min="1" max="'+data[i].count+'" class="block" oninput="updateCart(event, '+data[i].id+')"  value="' + data[i].count_current + '"><input type="text" class="block" readonly value="Осталось ' + data[i].count + ' шт."><input type="text" class="block" readonly value="Цена: ' + data[i].price + ' руб."><a href="/item.php?id=' + data[i].id + '"><button class="btn">Подробнее</button></a><button class="btn" onclick="deleteFromCart(event, '+data[i].id+')">Удалить</button></div>');
                }
                if (document.querySelectorAll('.it>*').length==0){
                emptyCart();
                }
                else{
                    it_container.insertAdjacentHTML('afterend', '<div class="container total"><div class="block">Итого: <span id="sum"></span></div><button class="btn" onclick="createOrder()">Оформить заказ</button></div>')
                    await getSum()
                }
            }
        )

}
async function deleteFromCart(event, id){
    await fetch('/func/deleteFromCart.php?id='+id).then(res=>res.json()).then(
        async data=>{
            event.target.parentNode.remove();
            emptyCart();
            await getSum();
        }
    )
}
async function updateCart(event, id){
    await fetch('/func/updateCart.php?id='+id+'&count='+event.target.value).then(res=>res.json()).then(
        async (data)=>{
            await getSum();
        }
    )
}
function emptyCart(){
    if (document.querySelectorAll('.it>*').length==0){
        it_container.insertAdjacentHTML('beforeend', '<h2 style="justify-content: center" class="block">Корзина пуста</h2>');
        document.querySelector('.total').remove();
    }
}
async function getSum(){
    await fetch('/func/getSum.php').then(res=>res.json()).then(
        data=>{
            document.getElementById('sum').innerHTML=data+' руб.'
        }
    )
}
async function createOrder(){
    await fetch('/func/createOrder.php').then(res=>res.json()).then(
        data=>{
            document.location.href='/hub.php';
        }
    )
}