let item_info = {};

let nameItem=document.item.name
let count =document.item.count;
let price = document.item.price;
let cat = document.item.cat;
let shop = document.item.shop;
let floor = document.item.floor
let logo = document.item.logo;
let img = document.querySelector('img.block');




const urlParams = new URLSearchParams(window.location.search);
const myParam = urlParams.get('id');

getItemInfo();

async function getItemInfo(){
    await fetch('/func/getItemInfo.php?id=' + myParam).then(res => res.json()).then(
        async (data) => {
            item_info=data;
            img.src=item_info.logo
            await getCatOnSelect();
        }
    )
}
async function getCatOnSelect() {
    await fetch('/func/getCategory.php?id=' + item_info.id_shop).then(res => res.json()).then(
        async (data) => {
            cat.innerHTML = '';
            for (let i = 0; i < data.length; i++) {
                cat.insertAdjacentHTML('beforeend', '<option value="' + data[i].id + '">' + data[i].name + '</option> ');
            }
            await drawItem();
        }
    )
}
function drawItem(){
    console.log(item_info.admin)
    if (item_info.admin=='0'){
        document.querySelector('.edit').remove();
        nameItem.setAttribute("readonly", "true");
        count.setAttribute("readonly", "true");
        price.setAttribute("readonly", "true");
        logo.remove();
        if (item_info.id_role==1) document.item.count_current.max = item_info.count;
        document.querySelector('.logoText').remove();
        cat.setAttribute("disabled", "true");
    }
    floor.setAttribute("readonly", "true");
    shop.setAttribute("readonly", "true");
    
    nameItem.value = item_info.name;
    count.value = item_info.count;
    price.value = item_info.price;
    cat.value = item_info.id_category;
    shop.value = item_info.shop_name;
    floor.value = item_info.floor;
}
async function updateItem(){
    let form = new FormData();
    form.append('name', nameItem.value);
    form.append('count',count.value);
    form.append('price', price.value);
    form.append('cat',cat.value);
    form.append('logo',logo.files[0]);
    form.append('logoR',item_info.logo);
    await fetch('/func/updateItem.php?id='+myParam, {method:'POST', body:form}).then(res=>res.json()).then(
        async (data)=>{
            await getItemInfo();
        }
    )
}
async function Buy(){
    let form = new FormData();
    form.append('id', myParam);
    form.append('name', item_info.name);
    form.append('logo', item_info.logo);
    form.append('price', item_info.price);
    form.append('cat', item_info.id_category);
    form.append('count', item_info.count);
    form.append('count_current', document.item.count_current.value);
    form.append('id_shop', item_info.id_shop);
    await fetch('/func/pushBasket.php', {method:'POST', body:form}).then(res=>res.json()).then(
        async (data)=>{
            document.location.href="/one-shop.php?id="+item_info.id_shop;
        }
    )
    
}