<!-- filter -->
<div class="filter">

    @foreach ($filter['groups'] as $group)
        <!-- filter-item -->
    <div class="filter-item">
        <div class="filter-title">{{$group->title}}</div>
        <div class="filter-content">
            <ul class="filter-list">

                @foreach ($group->attrs as $attr)
                <li>
                    <input type="checkbox" id="filter-{{$group->slug}}-{{$attr->slug}}">
                    <label for="filter-{{$group->slug}}-{{$attr->slug}}">{{$attr->title}}</label>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    @endforeach

    <!-- filter-item -->
    <div class="filter-item">
        <div class="filter-title">Цена</div>
        <div class="filter-content">
            <div class="price">
                <input type="text" class="price-input ui-slider-min" value="{{$filter['price_min']}}">
                <span class="price-sep"></span>
                <input type="text" class="price-input ui-slider-max" value="{{$filter['price_max']}}">
            </div>
            <div class="ui-slider"></div>
            <script>
               $('document').ready(function () {
                  $('.ui-slider').slider({
                     animate: false,
                     range: true,
                     values: [0, {{$filter['price_max']}}],
                     min: 0,
                     max: {{$filter['price_max']}},
                     step: 0.01,
                     slide: function (event, ui) {
                         if (ui.values[1] - ui.values[0] < 1) return false;
                         $('.ui-slider-min').val(ui.values[0]);
                         $('.ui-slider-max').val(ui.values[1]);
                     }
                  });
               });
            </script>
        </div>
    </div>
    <!-- filter-item -->
    <div class="filter-item">
        <div class="filter-content">
            <button class="btn">Сбросить фильтр</button>
        </div>
    </div>
</div>