let dataShop = {};
let data_container = document.querySelector('.data');
let category = [];
let categorySelect = [];
let category_container = document.querySelector('.cat');

let nameItem = document.items.name;
let logo = document.items.logo;
let count = document.items.count;
let price = document.items.price;
let cat = document.items.cat;
let total = document.querySelector('.total');
let it_container = document.querySelector('.it')


const urlParams = new URLSearchParams(window.location.search);
const myParam = urlParams.get('id');
getDataShop();

async function getDataShop() {
    await fetch('/func/getDataShop.php?id=' + myParam).then(res => res.json()).then(
        async data => {
            dataShop = data;
            console.log(dataShop)
            drawShop();
            await getItems();
            if (data.admin == 1) {
                // console.log(document.items.parentNode)
                document.items.parentNode.classList.remove('hide');
                await getCategory();
                await getCatOnSelect();
            }
        }
    )
}
function drawShop() {
    data_container.insertAdjacentHTML('beforeend', '<img class="block" src="' + dataShop.logo + '">');
    data_container.insertAdjacentHTML('beforeend', '<h4 class="block">' + dataShop.name + '</h4>');
    data_container.insertAdjacentHTML('beforeend', '<span class="block">' + dataShop.floor + '</span>');
    if (dataShop.admin == 1) data_container.insertAdjacentHTML('beforeend', '<a href="/orderShop.php?id=' + myParam + '"><button class="btn">Заказы магазина</button></a>');
}
async function getCategory() {
    await fetch('/func/getCategory.php?id=' + myParam).then(res => res.json()).then(
        data => {
            category = data;
            drawCategory();
        }
    )
}
function drawCategory() {
    category_container.classList.remove('hide');
    for (let i = 0; i < category.length; i++) {
        category_container.insertAdjacentHTML('beforeend', '<input class="block cat' + i + '" type="text" value="' + category[i].name + '" oninput="updateCategory(event, ' + category[i].id + ')">');
        category_container.insertAdjacentHTML('beforeend', '<button class="btn cat' + i + '" onclick="deleteCategory(' + i + ', ' + category[i].id + ')">Удалить</button>');
    }
    category_container.insertAdjacentHTML('beforeend', '<button class="btn " onclick="createCategory()">Создать</button>')
}
async function updateCategory(event, id) {
    await fetch('/func/updateCategory.php?id=' + id + '&name=' + event.target.value).then(res => res.json()).then(
        async (data) => {
            await getCatOnSelect();
        }
    )
}
async function deleteCategory(index, id) {
    await fetch('/func/deleteCategory.php?id=' + id).then(res => res.json()).then(
        async (data) => {
            let temp = document.querySelectorAll('.cat' + index);
            for (let i = 0; i < temp.length; i++) {
                temp[i].remove();
            }
            await getCatOnSelect();
        }
    )
}
async function createCategory() {
    let temp = document.querySelectorAll('.cat > *');
    for (let i = 0; i < temp.length; i++) {
        temp[i].remove();
    }
    await fetch('/func/createCategory.php?id=' + myParam).then(res => res.json()).then(
        async (data) => {
            await getCategory();
            await getCatOnSelect();
        }
    )

}
async function getCatOnSelect() {
    await fetch('/func/getCategory.php?id=' + myParam).then(res => res.json()).then(
        async (data) => {
            cat.innerHTML = '';
            for (let i = 0; i < data.length; i++) {
                cat.insertAdjacentHTML('beforeend', '<option value="' + data[i].id + '">' + data[i].name + '</option> ');
            }
            await getItems()
        }
    )
}
async function submitForm() {
    let form = new FormData();
    form.append('name', nameItem.value);
    form.append('logo', logo.files[0]);
    form.append('price', price.value);
    form.append('count', count.value);
    form.append('cat', cat.value);

    await fetch('/func/createItem.php', { method: 'POST', body: form }).then(res => res.json()).then(
        async (data) => {
            if (data.length != 0) {
                total.innerHTML = data;
                total.classList.remove('hide');
            }
            else {
                total.classList.add('hide');
            }
            await getItems();
            document.items.reset();
        }
    )
}
async function getItems() {
    console.log(dataShop)
    if (dataShop.admin == '0') {
        await fetch('/func/getItems.php?id=' + myParam).then(res => res.json()).then(
            data => {
                console.log(data)
                for (let i = 0; i < data.length; i++) {

                    it_container.insertAdjacentHTML('beforeend', '<div class="block item"><h5>' + data[i].name + '</h5><img src="' + data[i].logo + '"><input type="text" class="block" readonly value="' + data[i].cat_name + '"><input type="text" class="block" readonly value="Осталось ' + data[i].count + ' шт."><input type="text" class="block" readonly value="Цена: ' + data[i].price + ' руб."><a href="/item.php?id=' + data[i].id + '"><button class="btn">Подробнее</button></a></div>');
                }
            }
        )
    }
    else {
        await fetch('/func/getItemsOwner.php?id=' + myParam).then(res => res.json()).then(
            data => {
                let temp = document.querySelectorAll('.it > *');
                for (let i = 2; i < temp.length; i++) {
                    temp[i].remove();
                }
                for (let i = 0; i < data.length; i++) {

                    it_container.insertAdjacentHTML('beforeend', '<div class="block item"><h5>' + data[i].name + '</h5><img src="' + data[i].logo + '"><input type="text" class="block" readonly value="' + data[i].cat_name + '"><input type="text" class="block" readonly value="Осталось ' + data[i].count + ' шт."><input type="text" class="block" readonly value="Цена: ' + data[i].price + ' руб."><a href="/item.php?id=' + data[i].id + '"><button class="btn">Подробнее</button></a><button onclick="deleteItem(event,' + data[i].id + ')" class="btn">Удалить</button></div>');
                }
            }
        )
    }
}
async function deleteItem(event, id) {
    await fetch('/func/deleteItems.php?id=' + id).then(res => res.json()).then(
        async (data) => {
            event.target.parentNode.remove();
        }
    )
}