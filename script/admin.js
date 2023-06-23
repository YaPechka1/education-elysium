let floors = [];
let floorsData ="";
let floorDOM = document.querySelector('.floor');
let shopDOM = document.querySelector('.grid44')
let shops = [];
getFloor();
async function getFloor() {
    await fetch('/func/getFloor.php').then(res => res.json()).then(
        data => {
            floors = data;
            drawFloor();
        }
    )
}

function drawFloor() {
    for (let i = 0; i < floors.length; i++) {
        floorDOM.insertAdjacentHTML('beforeend', '<input type="number" data-floor="' + floors[i].floor + '" class="block del' + i + '" oninput="editChange(event)"  value="' + (floors[i].floor) + '">');
        floorDOM.insertAdjacentHTML('beforeend', '<input type="number" class="block del' + i + '" min="0" value="' + floors[i].count + '" oninput="editCount(event, '+floors[i].floor+')" >' );
        floorDOM.insertAdjacentHTML('beforeend', '<button onclick="deleteFloor(' + floors[i].floor + ', ' + i + ')" class="btn del' + i + '">Удалить</button>');
    }
    floorDOM.insertAdjacentHTML('beforeend', '<button class="btn" onclick="createFloor()">Добавить</button>');
    getFloorData();
}
async function createFloor() {

    await fetch('/func/createFloor.php').then(res => res.json()).then(
        async (data) => {
            let temp = document.querySelectorAll('.floor>*');
            for (let i = 4; i < temp.length; i++) {
                temp[i].remove()
            }
            await getFloor();
        }
    )
}
async function deleteFloor(id, index) {
    await fetch('/func/deleteFloor.php?id=' + id).then(res => res.json()).then(
        (data) => {
            let temp = document.querySelectorAll('.del' + index);
            for (let i = 0; i < temp.length; i++) {
                temp[i].remove()
            }
            getFloorData();
            // temp[index+3].remove();
            // temp[index+1].remove();
            // temp[index+3+2].remove();
        }
    )
}


async function editChange(event) {
    let id = event.target.dataset.floor;
    event.target.value = checkFloor(event.target.value, id);
    event.target.dataset.floor = event.target.value
    await fetch('/func/updateFloor.php?id=' + id + '&floor=' + event.target.value);
    getFloorData();

}
async function editCount(event, id) {
    let count = event.target.value;
    if (count<0) event.target.value =0;
    await fetch('/func/updateCount.php?id=' + id + '&count=' + event.target.value);
    getFloorData();

}
function checkFloor(floor, id) {
    console.log("New: "+floor+" Old: "+id)
    if (floor == 0) floor = 1;
    for (let i = 0; i < floors.length; i++) {
        console.log("New: "+floor+" Old: "+id+" Index: "+i+" Current: "+floors[i].floor)
        if (floor == id) break;
        // if (floors[i].floor == id) {floors[i].floor = id;}
        if (floor == floors[i].floor) { floor = '' + Number(Number(floors[i].floor) + 1);return checkFloor(floor, id); }
    }
    
    for (let i = 0; i < floors.length; i++) {
        if (floors[i].floor == id) floors[i].floor = floor
    }
    console.log(floors)
    return floor;
}
async function getFloorData() {
    await fetch('/func/getFloorOwner.php').then(res => res.json()).then(
        data => {
            floorsData = "";
            for (let i=0;i<data.length;i++){
                floorsData+='<option value="'+data[i].floor+'">'+data[i].floor+' этаж</option>'
            }
        }
    )
    await getShop();
}
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
        shopDOM.insertAdjacentHTML('beforeend', '<div id="'+shops[i].id+'" class="block item"><h5>'+shops[i].name+'</h5><img src="'+shops[i].logo+'"><select class="block" onchange="editFloorShop('+shops[i].id+', event)">'+floorsData+'</select><button onclick="deleteShop('+shops[i].id+')" class="btn">Удалить</button></div>');
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
async function editFloorShop(id, event){
    
    await fetch('/func/editFloorShop.php?id='+id+'&floor='+event.target.value);
}
