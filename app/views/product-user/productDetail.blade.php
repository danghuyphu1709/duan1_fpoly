@extends('layout-user.main')
@section('main-content')
<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__item">
                        <img class="product__details__pic__item--large"
                             src="{{ route('upload/').$product->avata }}" alt="" width="1000px" height="500px">
                    </div>
                    <div class="product__details__pic__slider owl-carousel">
                         @foreach($image as $iteams)
                        <img data-imgbigurl="{{ route('upload/').$iteams->source }}"
                             src="{{ route('upload/').$iteams->source }}" alt="">
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product__details__text">
                    <h3>{{ $product->name }}</h3>
                    <div class="product__details__rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                        <span>(18 reviews)</span>
                    </div>
                    <div class="product__discount__item__text" style="text-align: left;">
                        <div class="product__item__price"><span style=";font-size: 27px" id="priceAfter"></span></div>
                    </div>

                    <div class="product__details__price" id="price">

                    </div>

                    <p>{{ $product->description }}</p>
                    <form action="{{ route('cart') }}" method="post" id="form-add-to-cart" autocomplete="off">
                        <input type="hidden" value="{{ $_SESSION['csrf_token'] }}" name="csrf_token">
                        <input type="hidden" value="{{ $product->id }}" name="product_id">
                    <div class="form-group ">
                        <select class="form-select product__details__quantity" id="optionSize" name="product_detail_id">
                               <option value="0"> chọn size </option>
                            @foreach($size as $iteams)
                                @if($iteams->quantity == 0)
                                    <option value="{{ $iteams->detail_id }}" disabled>{{ $iteams->name }}</option>
                                @else
                                    <option value="{{ $iteams->detail_id }}" >{{ $iteams->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="product__details__quantity">
                        <div class="quantity">
                            <div class="pro-qty" id="product-quantity-key">
                                <input type="text" value="1" max="100" min="1" name="quantity" id="product-quantity">
                            </div>
                        </div>
                    </div>
                        <button type="submit" class="primary-btn">ADD TO CARD</button>
                    <div><span id="errors" style="color: red"></span></div>

                    </form>
                    <ul>
                        <li><b>Danh mục</b> <span>{{ $product->category_name  }}</span></li>
                        <li><b>Shipping</b> <span>01 day shipping. <samp>Free pickup today</samp></span></li>
                        <li><b>Weight</b> <span>0.5 kg</span></li>
                        <li><b>Share on</b>
                            <div class="share">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="product__details__tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                               aria-selected="true">Description</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                               aria-selected="false">Reviews <span>(1)</span></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <h6>Products Infomation</h6>
                                <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                    Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus. Vivamus
                                    suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam sit amet quam
                                    vehicula elementum sed sit amet dui. Donec rutrum congue leo eget malesuada.
                                    Vivamus suscipit tortor eget felis porttitor volutpat. Curabitur arcu erat,
                                    accumsan id imperdiet et, porttitor at sem. Praesent sapien massa, convallis a
                                    pellentesque nec, egestas non nisi. Vestibulum ac diam sit amet quam vehicula
                                    elementum sed sit amet dui. Vestibulum ante ipsum primis in faucibus orci luctus
                                    et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam
                                    vel, ullamcorper sit amet ligula. Proin eget tortor risus.</p>
                                <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Lorem
                                    ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit aliquet
                                    elit, eget tincidunt nibh pulvinar a. Cras ultricies ligula sed magna dictum
                                    porta. Cras ultricies ligula sed magna dictum porta. Sed porttitor lectus
                                    nibh. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.
                                    Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Sed
                                    porttitor lectus nibh. Vestibulum ac diam sit amet quam vehicula elementum
                                    sed sit amet dui. Proin eget tortor risus.</p>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="container bootdey">
                                    <div class="col-md-12 bootstrap snippets">
                                        <div class="panel">
                                            <div class="panel-body">
                                                <form class="form-block" id="formComment" method="post">
                                                <textarea class="form-control" rows="2" placeholder="What are you thinking?" name="description" id="description"></textarea>
                                                    <span style="color: red" id="comment_errors"></span>
                                                <div class="mar-top clearfix">
                                                    <button class="btn btn-sm btn-primary pull-right" type="submit"><i class="fa fa-pencil fa-fw"></i>Comment</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="panel" id="main-content" style="max-height: 500px; overflow: auto;">
                                            @foreach($comment as $iteams)
                                                <div class="panel-body">
                                                    <!-- Newsfeed Content -->
                                                    <!--===================================================-->

                                                    @if($iteams->avatar === null)
                                                        <a class="media-left"  href="{{ route('profile/').$iteams->account_id }}">
                                                            <img class="img-circle img-sm" alt="Profile Picture" src="https://bootdey.com/img/Content/avatar/avatar1.png">
                                                        </a>
                                                    @else
                                                        <a class="media-left" href="{{ route('profile/').$iteams->account_id  }}">
                                                            <img class="img-circle img-sm" alt="Profile Picture" src="{{ route('upload/').$iteams->avatar }}">
                                                        </a>
                                                    @endif

                                                    <div class="media-body">
                                                        <div class="mar-btm">
                                                            <a  href="{{ route('profile/').$iteams->account_id  }}" class="btn-link text-semibold media-heading box-inline">{{ $iteams->name }}</a>
                                                            <p style="color: green" class="mt-2">{{$iteams->name_role}}</p>
                                                            <p class="text-muted text-sm"><i class="fa fa-mobile fa-lg"></i> {{ $iteams->create_at }}</p>
                                                        </div>
                                                        <p class="mar-btm-content">{{ $iteams->content }}</p>
                                                        <hr>
                                                        <!-- Comments -->
                                                    </div>
                                                </div>
                                                <!--===================================================-->
                                            @endforeach
                                            <div class="text-center">
                                                <button type="button" class="btn-success">Xem thêm</button>
                                            </div>
                                        </div>
                                    </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Details Section End -->

<!-- Related Product Section Begin -->
<section class="related-product">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title related__product__title">
                    <h2>Sản phẩm liên quan</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($relatedProducts as $iteams)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="product__item">
                    <div class="product__item__pic set-bg"
                         data-setbg="{{ route('upload/').$iteams->avata }}">
                        <ul class="product__item__pic__hover">
                            <li><a href="{{ route('productDetail/').$iteams->id }}"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                    </div>
                    <div class="featured__item__text">
                        <span><a href="{{ route('category/').$iteams->category_id }}">{{ $iteams->category_name }}</a></span>
                        <h6><a href="{{ route('productDetail/').$iteams->id }}">{{ $iteams->name }}</a></h6>
                        @if($iteams->price_max == $iteams->price_min)
                            <h5>{{ number_format($iteams->price_min,0, ',', '.')}}đ</h5>
                        @else
                            <h5>{{ number_format($iteams->price_min,0, ',', '.')}}đ
                                - {{ number_format($iteams->price_max,0, ',', '.')}}đ</h5>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <script src="{{BASE_URL.'source-user/customer/ajax.js'}}"></script>
</section>
@endsection