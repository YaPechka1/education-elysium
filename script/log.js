let login = document.log.login; 
let password = document.log.password; 
let total = document.querySelector('.total')

async function submitForm(){
    
    let form = new FormData();
    form.append('login', login.value);
    form.append('password', password.value);
    
    await fetch('/func/log.php', {method:'POST', body:form}).then(res=>res.json()).then(
        (data)=>{
            if (data.length ==0 ) document.location.href = '/hub.php';
            else {
                total.innerHTML = data;
                total.classList.remove('hide');
            }
        }
    )
    
}