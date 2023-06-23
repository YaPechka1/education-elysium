let nameUser = document.reg.name; 
let login = document.reg.login; 
let email = document.reg.email; 
let id_role = document.reg.id_role;
let password = document.reg.password; 
let total = document.querySelector('.total')

async function submitForm(){
    
    let form = new FormData();
    form.append('name', nameUser.value);
    form.append('login', login.value);
    form.append('email', email.value);
    form.append('id_role', id_role.value);
    form.append('password', password.value);
    
    await fetch('/func/reg.php', {method:'POST', body:form}).then(res=>res.json()).then(
        (data)=>{
            if (data.length ==0 ) document.location.href = '/log.php';
            else {
                total.innerHTML = data;
                total.classList.remove('hide');
            }
        }
    )
    
}