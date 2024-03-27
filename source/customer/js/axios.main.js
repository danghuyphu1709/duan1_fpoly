$(document).ready(function (){
    $("#promotion_id").change(function (){
        var id = $(this).val();
        var priceWithCurrency = $('#price_value_now').text().trim(); // Lấy nội dung văn bản bên trong thẻ td
        var price = parseFloat(priceWithCurrency.replace(/[.,VND]/g, '').replace(',', '.')); // Loại bỏ dấu phẩy, dấu chấm và ký tự VND, rồi chuyển thành số thực
        $.ajax({
            url:'http://localhost/duan1_fpoly/checkAfterPrice',
            method: 'POST',
            data : {id:id,price:price},
            success: function (data){
                $('#price_after').html(data);
            }
        })
    })
});
