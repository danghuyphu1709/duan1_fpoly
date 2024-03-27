$(document).ready(function (){
    $("#formCheckDiscount").submit((event)=>{
        event.preventDefault();
        var input  = $("#keyword").val();
        if(input.length === 0){
            $("#errorsKeyword2").html('');
            $("#errorsKeyword").html('Vui lòng nhập code giảm giá');
        }else{
            $("#formCheckDiscount")[0].submit();
        }
    });

    $("#discount-cart").on("change",function (){
        var id  = $(this).val();
            $.ajax({
                url : 'http://localhost/duan1_fpoly/discountPublic',
                method : 'post',
                data : {id:id},
                success : (data)=>{
                    var value = JSON.parse(data);
                    if(value.check != 0){
                        $("#apply").html(numberFormat(`-${value.price_after_apply}`))
                        $("#value").html(`${value.value}%`);
                        $("#total_price").html(numberFormat(`${value.total_apply_discount}`))
                    }else{
                        $("#apply").html(""); // Xóa nội dung
                        $("#value").html(""); // Xóa nội dung
                        $("#total_price").html(numberFormat(`${value.total_cart}`));
                    }

                }
            })

    })



    function numberFormat(number) {
        if (typeof number !== 'number') {
            number = parseFloat(number);
        }

        if (isNaN(number)) {
            return '';
        }
        return number.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, '.') + 'đ';
    }
});


