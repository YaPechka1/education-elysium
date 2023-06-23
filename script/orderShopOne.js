let it_container = document.querySelector('.it');
let items =[];
let option = "<option value='0'>В обработке</option><option value='1'>Собран</option>";

const urlParams = new URLSearchParams(window.location.search);
const myParam = urlParams.get('id');
const myParam1 = urlParams.get('id_shop')

getItems();
async function getItems() {
    
        await fetch('/func/getOrderOneShop.php?id='+myParam+'&id_shop='+myParam1).then(res => res.json()).then(
            async (data) => {
                items = data;
                for (let i = 0; i < data.length; i++) {
                    it_container.insertAdjacentHTML('beforeend', '<div class="container"><h5 class="block">' + data[i].item_name + '</h5><img class="block" src="' + data[i].logo + '"><select class="block" onchange="changeStatus(event,'+data[i].id+')" data-val="' + data[i].status + '">'+option+'</select><input type="text" class="block" readonly  value="Количество: ' + data[i].count + '"><input type="text" class="block" readonly value="Цена: ' + data[i].price + ' руб."><input type="text" class="block" readonly value="Категория: ' + data[i].cat_name + '"><input type="text" class="block" readonly value="Магазин: ' + data[i].shop_name + '"><a href="/item.php?id=' + data[i].id + '"><a href="/item.php?id=' + data[i].id_item + '"><button class="btn">Подробнее</button></a></div>');
                }
                selectEdit();
            }
        )

}
function selectEdit(){
    let tempSelect = document.querySelectorAll('select');
    for (let i=0;i<tempSelect.length;i++){
        let tempOption = tempSelect[i].querySelectorAll('option');
        for (let z=0;z<tempOption.length;z++){
            if (tempSelect[i].dataset.val==tempOption[z].value) {
                tempOption[z].setAttribute("selected", "true"); break
            }
        }
    }
}
async function changeStatus(event,id){
    await fetch('/func/updateStatus.php?id='+id+'&status='+event.target.value)
}