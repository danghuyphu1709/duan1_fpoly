@extends('layout-user.main')
@section('main-content')
    <section class="product spad">
        <!-- breadcrumb -->
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">

                        <div class="sidebar__item">
                            <h4>Danh mục sản phẩm</h4>
                            <ul>
                                                                @foreach($category as $iteams)
                                                                    <li><a href="{{ route('category/').$iteams->id }}">{{ $iteams->name }}</a></li>
                                                                @endforeach
                            </ul>
                        </div>
                        <div class="sidebar__item">
                            <h4>Lọc theo giá</h4>
                            <div class="price-range-wrap">
                                <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                     data-min="10" data-max="100000">
                                    <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                </div>
                                <div class="range-slider">
                                    <div class="price-input">
                                        <input type="text" id="minamount">
                                        <input type="text" id="maxamount">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar__item">
                            <h4>Popular Size</h4>
                            <div class="sidebar__item__size">
                                <label for="large">
                                    Large
                                    <input type="radio" id="large">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="medium">
                                    Medium
                                    <input type="radio" id="medium">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="small">
                                    Small
                                    <input type="radio" id="small">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="tiny">
                                    Tiny
                                    <input type="radio" id="tiny">
                                </label>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    <!-- breadcrumb -->
                    <div class="container">
                        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
                            <a href="{{ route('shop') }}" class="customer_a cl8 hov-cl1 trans-04" style=" color: inherit; text-decoration: none;">
                                Shop
                            </a>
                            <span><i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i></span>
                            <span class="stext-109 cl4" id="location">
			                 Sản phẩm
		                    </span>
                        </div>
                    </div>

                    <div class="filter__item mt-2">
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <div class="filter__sort">
                                    <span>Sắp xếp theo</span>
                                    <select id="filter-short">
                                        <option value="0">Mới Nhất</option>
                                        <option value="1">Cũ Nhất</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="filter__found">
                                    <h6 id="quantityProduct"><span>{{ $productAll }}</span> Sản phẩm</h6>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-3">
                                <div class="filter__option">
                                    <span class="icon_grid-2x2"></span>
                                    <span class="icon_ul"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="product_page">
                        @foreach($product as $iteams)
                            <div class="col-lg-4 col-md-6 col-sm-6">
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
                    @if(isset($number_page))
                        <div class="product__pagination text-center" id="page">
                            @for( $i = 1 ; $i <= $number_page ; $i++)
                                <a href="{{ route('product/').$i }}">{{ $i }}</a>
                            @endfor
                        </div>
                    @endif
                    <script src="{{BASE_URL.'source-user/customer/ajax.js'}}"></script>
                    <link rel="stylesheet" href="{{BASE_URL.'source-user/customer/styleCustomer.css'}}">
                </div>
            </div>
        </div>
    </section>
@endsection