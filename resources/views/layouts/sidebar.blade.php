<div class="col-md-3 sidebar">
    <div class="sale-title-bar">
        <div class="sale-parentcategory-title">
            <a href="">KHUYẾN MÃI LỚN</a>
        </div>
    </div>
    @foreach($sale_products as $sale_product)
        <div class="product-item">
            <a href="{{ route('product', $sale_product->id) }}" title="{{ $sale_product->name }}">
                <div class="product-image">
                    @foreach($sale_product->photo as $photo)
                        @if($photo->is_cover == 1)
                            <img class="product-thumbnail" src="{{ $photo->photo_url }}" />
                        @endif
                    @endforeach
                    <span class="discount">
                            <img src="{{ asset('images/sale-tag.png') }}" width="60" />
                        </span>
                    <span class="discount-title">-{{ round($sale_product->sale*100/$sale_product->price, 0) }}%</span>
                </div>
                <div class="product-title">
                    {{ limit_character($sale_product->name) }}
                </div>
                <div class="product-priceold">
                    {{ format_money($sale_product->price) }} VND
                </div>
                <div class="product-price">
                    {{ format_money($sale_product->price - $sale_product->sale) }} VND
                </div>
                <div class="product-review">
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                </div>
            </a>
        </div>
    @endforeach
</div>