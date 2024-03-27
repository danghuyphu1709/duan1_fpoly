$(document).ready(function (){
    $("#province").on("change",function (){
        var id  = $(this).val();

        $.ajax({
            url : 'http://localhost/duan1_fpoly/district',
            method : 'POST',
            data : {id:id},
            success : (data)=>{
                var value = JSON.parse(data);
                var html = '<select class="select_form_adress" aria-label="Default select example" name="district"><option value="0" selected>Chọn Quận/Huyện</option>';
                value.forEach(function(item) {
                    html += `<option value="${item.id}">${item.name}</option>`;
                });

                html += '</select>';

                $("#district").html(html);

                $("#district").css("display", "block");
            }
        })

    });

    $("#district").on("change",function (){
        var id  = $(this).find(':selected').val();
        $.ajax({
            url : 'http://localhost/duan1_fpoly/ward',
            method : 'POST',
            data : {id:id},
            success : (data)=>{
                var value = JSON.parse(data);
                var html = '<select class="select_form_adress" aria-label="Default select example" name="ward"> <option value="0" selected>Chọn Xã/Phường</option>';

                value.forEach(function(item) {
                    html += `<option value="${item.id}">${item.name}</option>`;
                });

                html += '</select>';

                $("#ward").html(html);

            }
        })

    });

    $("#ward").on("change",function (){
        var id  = $(this).find(':selected').val();
        $.ajax({
            url : 'http://localhost/duan1_fpoly/village',
            method : 'POST',
            data : {id:id},
            success : (data)=>{
                var value = JSON.parse(data);
                var html = '<select class="select_form_adress" aria-label="Default select example" name="village"> <option value="0" selected>Chọn Xóm/Ngõ</option>';

                value.forEach(function(item) {
                    html += `<option value="${item.id}">${item.name}</option>`;
                });

                html += '</select>';

                $("#village").html(html);

            }
        })

    });



    $('#form-address').on("submit",function (event){
        event.preventDefault();
        var province  = $("#province").val();
        var district  = $("#district").find(':selected').val();
        var ward  = $("#ward").find(':selected').val();
        var village  = $("#village").find(':selected').val();

        var name = $("#name").val();
        var phone = $("#phone").val();
        var adress_detail = $("#address_detail").val();

         var hasErrors = false;

        if( name.trim() === '' || name.length < 3 || name.length > 25){
            $("#errors_name").html('Vui lòng nhập đúng cú pháp')
            hasErrors = true;
        }else{

            $("#errors_name").html('')
        }

        if(phone.trim() == '' ||  phone.length == 11){
            $("#errors_phone").html('Vui lòng nhập đúng cú pháp')
            hasErrors = true;
        }else{
            $("#errors_phone").html('')
        }

        if(adress_detail.trim() == '' || adress_detail.length < 3 || adress_detail.length > 255){
            $("#errors_address_detail").html('Vui lòng nhập đúng cú pháp')
            hasErrors = true;
        }else{
            $("#errors_address_detail").html('')
        }

        if(province == 0 || province == ''){
            $("#erorrs_select").html('Vui lòng chọn tỉnh / thành phố')
            hasErrors = true;
        }
        if(district == 0 || district == ''){
            $("#erorrs_select").html('Vui lòng chọn Quận / Huyện')
            hasErrors = true;
        }
        if(ward == 0 || ward == ''){
            $("#erorrs_select").html('Vui lòng chọn Xã / Phường')
            hasErrors = true;
        }
        if(village == 0 || village == ''){
            $("#erorrs_select").html('Vui lòng chọn Xóm / Ngõ')
            hasErrors = true;
        }

        if (!hasErrors) {
            $(this)[0].submit();
        }

    })

});