$(document).ready(function (){
    $("#filter-short").on("change",() => {
        var page = $(this).find(":selected").val();
        $.ajax({
            url:"http://localhost/duan1_fpoly/filter",
            method: 'POST',
            data : {page:page},
            success: function (data){
                var product = $("#product_page");
                $("#page").html('');
                $("#location").text('Lọc sản phẩm');
                var products = JSON.parse(data);
                $("#quantityProduct").html(`<span>${products.length}</span> Sản phẩm`);
                // Tạo chuỗi HTML động
                var html = '';
                products.forEach(function (item) {
                    html += `
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="product__item">
                    <div class = "product__item__pic set-bg" data-setbg ="http://localhost/duan1_fpoly/upload/${item.avata}" style="background-image: url('http://localhost/duan1_fpoly/upload/${item.avata}')">
                        <ul class="product__item__pic__hover">
                            <li><a href="http://localhost/duan1_fpoly/productDetail/${item.id}"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="featured__item__text ">
                       <span><a href="http://localhost/duan1_fpoly/category/${item.category_id}">${item.category_name}</a></span>
                        <h6><a href="http://localhost/duan1_fpoly/productDetail/${item.id}">${item.name}</a></h6>
                        ${item.price_max == item.price_min ? `<h5>${numberFormat(item.price_min)}</h5>` : `<h5>${numberFormat(item.price_min)} - ${numberFormat(item.price_max)}</h5>`}
                    </div>
                </div>
            </div>
        `;
                });
                // Thêm chuỗi HTML vào phần tử sản phẩm
                product.html(html);
            }
        });
    });

    $('#optionSize').on('change',()=>{
        var detail_id = $(this).find(":selected").val();
        if(detail_id != 0){
            $('#errors').html('');
            $.ajax({
                url: "http://localhost/duan1_fpoly/price",
                method: "POST",
                data: {detail_id:detail_id},
                success : (data)=>{
                    var parsedData = JSON.parse(data);
                    if(parsedData.price_after_reduction == null){
                        $("#price").html(numberFormat(parsedData.price));
                        $("#priceAfter").html('');
                    }else{
                        $("#price").html(numberFormat(parsedData.price_after_reduction));
                        $("#priceAfter").html(numberFormat(parsedData.price));
                    }
                }
            })

        }else if(detail_id == 0){
            $('#errors').html('Vui lòng chọn size');
            $("#priceAfter").html('');
            $("#price").html('');
        }

    })


    $('#formComment').submit((event)=>{
        event.preventDefault();
        var currentUrl = window.location.href;
        var id = currentUrl.substring(currentUrl.lastIndexOf('/') + 1);
        var description = $('#description').val();
        $errors = false;
        if(!description || description.trim() === ''){
             $("#comment_errors").html('Vui lòng nhập thông tin');
             $errors = true;
        }
        if(!$errors){
            $.ajax({
                url:"http://localhost/duan1_fpoly/comment",
                method: 'POST',
                data : {id:id,description:description},
                success : (data)=>{
                    var result = JSON.parse(data);
                    if(result){
                        $('#description').val('');
                        var  url = "http://localhost/duan1_fpoly/upload/"+`${result.avatar}`;
                        var profile = "http://localhost/duan1_fpoly/profile/"+`${result.account_id}`
                        var image = "https://bootdey.com/img/Content/avatar/avatar1.png";
                        var newComment = `<div class="panel-body">
                                                <!-- Newsfeed Content -->
                                                <!--===================================================-->
                                                <a class="media-left" href="${profile}"><img class="img-circle img-sm" alt="Profile Picture" src="${result.avatar ? url : image }"></a>
                                                    <div class="media-body">
                                                        <div class="mar-btm">
                                                            <a href="${profile}" class="btn-link text-semibold media-heading box-inline">${result.name}</a>
                                                            <p style="color: green" class="mt-2">${result.name_role}</p>
                                                            <p class="text-muted text-sm"><i class="fa fa-mobile fa-lg"></i>${result.create_at}</p>
                                                        </div>
                                                        <p class="mar-btm-content">${result.content}</p>
                                                        <hr>
                                                        <!-- Comments -->
                                                    </div>
                                                </div>`
                        $('#main-content').prepend(newComment);
                    }
                }
            })
        }
    })


    $('#form-add-to-cart').on("submit",(event)=>{
        event.preventDefault();
        var sizeOption = $("#optionSize");
        var productQuantity = $("#product-quantity");

        var hasErrors = false;

        if(isNaN(+productQuantity.val()) || +productQuantity.val() === 0 || productQuantity.val() === ''){
            $('#errors').html('Vui lòng chọn số lượng');
            hasErrors = true;
        }else{
            hasErrors = false;
        }

         if(+sizeOption.val() === 0){
            $('#errors').html('Vui lòng chọn size');
             hasErrors = true;
        }

        if (!hasErrors) {
            $('#form-add-to-cart')[0].submit();
        } else {
            console.log('notgui');
        }

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
})