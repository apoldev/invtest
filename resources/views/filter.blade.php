<!-- filter -->
<div class="filter">

    @foreach ($filter['groups'] as $group)
        <!-- filter-item -->
    <div class="filter-item">
        <div class="filter-title">{{$group['title']}}</div>
        <div class="filter-content">
            <ul class="filter-list">

                @foreach ($group['attrs'] as $attr)
                <li>
                    <input type="checkbox" data-group="{{$group['slug']}}" data-attr="{{$attr['slug']}}" id="filter-{{$group['slug']}}-{{$attr['slug']}}" {{$attr['checked'] ? 'checked' : ''}}>
                    <label for="filter-{{$group['slug']}}-{{$attr['slug']}}">{{$attr['title']}}</label>
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
                <input type="text" class="price-input ui-slider-min" value="{{$filter['price_filter'][0]}}">
                <span class="price-sep"></span>
                <input type="text" class="price-input ui-slider-max" value="{{$filter['price_filter'][1]}}">
            </div>
            <div class="ui-slider"></div>



            <script>

               $('document').ready(function () {


                // По-хорошему нужно было создать отдельный массив, который можно сделать публичным/
                // И указать там свойства без айдишников и тд
                let config = @json($filter)

                function changeFilters(){

                    let o = {}


                    let priceFrom = parseFloat($('.ui-slider-min').val());
                    let priceTo = parseFloat($('.ui-slider-max').val())

                    if(priceFrom != config.price_min){
                        o['priceFrom'] = priceFrom;
                    }

                    if(priceTo != config.price_max){
                        o['priceTo'] = priceTo;
                    }
                    

                    $('.filter-list').find('input:checked').each(function(){

                        let group = $(this).attr('data-group')
                        let attr = $(this).attr('data-attr')

                        if(!o[group]){
                            o[group] = []
                        }

                        o[group].push(attr);
                        

                    })


                    var query = Object.keys(o)
                    .map(k => k + '=' + (typeof o[k] == "array" ? o[k].join(',') : o[k]))
                    .join('&');

                    location.href = '/catalog?' + query;
                }

                $('.filter-list').find('input').change(function(e){
                    let el = $(this);
                    console.log("change", el.attr('data-group'), el.attr('data-attr'))


                    changeFilters();
                });

                $('.clear_filter').click(function(){
                    location.href = '/catalog'
                });


                  $('.ui-slider').slider({
                     animate: false,
                     range: true,
                     values: [config.price_filter[0], config.price_filter[1]],
                     min: config.price_min,
                     max: config.price_max,
                     step: 0.01,
                     slide: function (event, ui) {
                         if (ui.values[1] - ui.values[0] < 1) return false;
                         $('.ui-slider-min').val(ui.values[0]);
                         $('.ui-slider-max').val(ui.values[1]);


                         
                     },
                     change: function(event, ui){
                        changeFilters();
                     }
                  });
               });
            </script>
        </div>
    </div>
    <!-- filter-item -->
    <div class="filter-item">
        <div class="filter-content">
            <button class="btn clear_filter">Сбросить фильтр</button>
        </div>
    </div>
</div>