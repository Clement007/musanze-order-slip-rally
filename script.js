const qty=document.getElementById('qty');
const price=document.getElementById('price');
const total=document.getElementById('total');
function calculateTotal(){
    let q=parseFloat(qty.value);
    let p=parseFloat(price.value);
    total.value=q*p;
}
qty.addEventListener('input',calculateTotal);
price.addEventListener('input',calculateTotal);