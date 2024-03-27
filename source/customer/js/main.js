// form-add-product 
const form_add_product = document.getElementById('form_add_product');
const box_size = form_add_product.querySelectorAll('.box-size');
const size = form_add_product.querySelectorAll('.size');
const quantity = form_add_product.querySelectorAll('.quantity');
const btn = form_add_product.querySelectorAll('.btn-delete');
const price_input = form_add_product.querySelectorAll('.price-input');
for(let i = 0; i < box_size.length; i++) {
    btn[i].addEventListener('click',() => {
      const check =confirm('bạn muốn xóa size này chứ ?');
      if(check){
        size[i].removeAttribute('name');
        price_input[i].removeAttribute('name');
        quantity[i].removeAttribute('name');
        box_size[i].style = 'display: none';
        console.log(size[[i]]);
        console.log(price_input[i]);
      }
    })
}
function clearForm(){
  var inputs = document.querySelectorAll("form input");
  inputs.forEach(function(input){
    input.value = "";
  });
  console.log(inputs);
}
