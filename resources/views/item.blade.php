<!--  -->
<div class="column col-4">
    <div class="element">
        <div class="element-image">
            <img src="{{$item->image_uri}}" alt="">
        </div>
        <div class="element-title">
            <a href="">{{$item->title}}</a>
        </div>
        <div class="element-price">{{$item->price_human}} ₽</div>

        <div style="margin: 10px 0px 0px; font-size: 10px; line-height:10px; text-align: right">
            @foreach ($item->attrs as $attr)
                <p>{{$attr->title}}</p>
            @endforeach
        </div>
    </div>
</div>   
<!--  -->