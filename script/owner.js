let floors =[];
let shops = [];
let nameShop=document.shop.name;
let logo=document.shop.logo;
let floor = document.shop.floor;
let total = document.querySelector('.total');
let shopDOM = document.querySelector('.grid44')

getFloor();

async function getFloor() {
    await fetch('/func/getFloorOwner.php').then(res => res.json()).then(
        data => {
            floors = data;
            drawFloor();
        }
    )
}
function drawFloor(){
    floor.innerHTML='';
    for (let i=0;i<floors.length;i++){
        floor.insertAdjacentHTML('beforeend', '<option value="'+floors[i].floor+'">'+floors[i].floor+' этаж</option>');
    }
    getShop()
}
async function getShop(){
    await fetch('/func/getShopOwner.php').then(res=>res.json()).then(
        data=>{
            shops=data;
            drawShops();
        }
    )
}
function drawShops(){
    shopDOM.innerHTML='';
    for (let i=0;i<shops.length;i++){
        shopDOM.insertAdjacentHTML('beforeend', '<div id="'+shops[i].id+'" class="block item"><h5>'+shops[i].name+'</h5><img src="'+shops[i].logo+'"><select class="block" onchange="editFloorShop('+shops[i].id+', event)">'+floor.innerHTML+'</select><a href="/one-shop.php?id='+shops[i].id+'"><button class="btn">Подробнее</button></a><button onclick="deleteShop('+shops[i].id+')" class="btn">Удалить</button></div>');
    }
    let temp = document.querySelectorAll('.grid44 > *');
    for (let i=0;i<temp.length;i++){
        let option = temp[i].querySelectorAll('option');
        for (let z=0;z<option.length;z++){
            if (option[z].value==shops[i].floor) {option[z].setAttribute('selected','true');break}
        }
    }
}
async function deleteShop(index){
    await fetch('/func/deleteShop.php?id='+index).then(res=>res.json()).then(
        data=>{
            document.getElementById(index).remove();
        }
    )
}
async function submitForm(){
    let form = new FormData();
    form.append('name', nameShop.value);
    form.append('logo', logo.files[0]);
    form.append('floor', floor.value);
    
    await fetch('/func/createShop.php', {method:'POST', body:form}).then(res=>res.json()).then(
        async (data)=>{
            if (data.length !=0 ) {
                total.innerHTML = data;
                total.classList.remove('hide');
            }
            else{
                total.classList.add('hide');
            }
            document.shop.reset();
            await getFloor();
        }
    )
}
async function editFloorShop(id, event){
    
    await fetch('/func/editFloorShop.php?id='+id+'&floor='+event.target.value);
}