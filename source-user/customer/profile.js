$(document).ready(function (){
    $("#edit").on("click",function (){
        var form = $("#form");
        $.ajax({
            url : 'http://localhost/duan1_fpoly/profile',
            method : 'POST',
            success : function (data){
                var value = JSON.parse(data);
                var html = `<div class="card mb-3">
                    <form action="http://localhost/duan1_fpoly/update/profile/${value.id}" method="post" enctype="multipart/form-data" id="form-edit-profile">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0"> Tên </h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                             <input id="name" type="text" name="name" class="form-control" value=" ${value.name}" id="exampleInputEmail1" aria-describedby="emailHelp"">
                             <span id="nameErorrs" style="color: red"></span>
                            </div>
                            
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                            <input id="email" type="email" name="email" class="form-control" value="${value.email}" id="exampleInputEmail1" aria-describedby="emailHelp"">
                              <span id="emailErorrs" style="color: red"></span>
                            </div>
                            
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Phone</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                              
                             <input id="phone" type="number" name="phone" class="form-control" value="${value.phone}" id="exampleInputEmail1" aria-describedby="emailHelp"">
                             <span id="phoneErorrs" style="color: red"></span>
                            </div>
                        </div>
                         <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Ảnh đại diện</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                             <input id="avata" type="file" name="avata" id="exampleInputEmail1" aria-describedby="emailHelp">
                             <input id="avataold" type="hidden" name="avataold" value="${value.avatar ?? ''}">
                             <span id="avataErorrs" style="color: red"></span>                            
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <button class="btn btn-info" type="submit">Gửi</button>
                            </div>
                        </div>
                    </div>
                </div> 
                </form>`
                form.html(html);
                $("#form-edit-profile").submit(function (event){
                    event.preventDefault();
                    var name  = $(this).find("#name").val();
                    var email  = $(this).find("#email").val();
                    var phone  = $(this).find("#phone").val();
                    var hasErorrs = false;
                     if(name.length < 3 || name.length > 25){
                         $("#nameErorrs").html('Độ dài không từ 3 đến 25 kí tự');
                         hasErorrs = true;
                     }else{
                         $("#nameErorrs").html('');
                     }

                    if(email.length === 0){
                        $("#emailErorrs").html('Không được để trống email');
                        hasErorrs = true;
                    }else{
                        $("#emailErorrs").html('');
                    }

                    if(phone.length !== 9){
                        $("#phoneErorrs").html('số điện thoại không hợp lệ');
                        hasErorrs = true;
                    }else{
                        $("#phoneErorrs").html('');
                    }
                    if(!hasErorrs){
                        $(this)[0].submit();
                    }
                })
            },
        })


    })



})