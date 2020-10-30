<!-- filter -->
<div class="filter">
    <!-- filter-item -->
    <div class="filter-item">
        <div class="filter-title">Размер</div>
        <div class="filter-content">
            <ul class="filter-list">
                <li>
                    <input type="checkbox" id="filter-size-1">
                    <label for="filter-size-1">1,5 спальный</label>
                </li>
                <li>
                    <input type="checkbox" id="filter-size-2">
                    <label for="filter-size-2">2,0 спальный</label>
                </li>
                <li>
                    <input type="checkbox" id="filter-size-3">
                    <label for="filter-size-3">2,0 спальный с евро</label>
                </li>
                <li>
                    <input type="checkbox" id="filter-size-4">
                    <label for="filter-size-4">детский</label>
                </li>
                <li>
                    <input type="checkbox" id="filter-size-5">
                    <label for="filter-size-5">евро</label>
                </li>
                <li>
                    <input type="checkbox" id="filter-size-6">
                    <label for="filter-size-6">семейный</label>
                </li>
            </ul>
        </div>
    </div>
    <!-- filter-item -->
    <div class="filter-item">
        <div class="filter-title">Ткань</div>
        <div class="filter-content">
            <ul class="filter-list">
                <li>
                    <input type="checkbox" id="filter-tkan-1">
                    <label for="filter-tkan-1">поплин</label>
                </li>
                <li>
                    <input type="checkbox" id="filter-tkan-2">
                    <label for="filter-tkan-2">искусственный шелк</label>
                </li>
                <li>
                    <input type="checkbox" id="filter-tkan-3">
                    <label for="filter-tkan-3">микросатин</label>
                </li>
                <li>
                    <input type="checkbox" id="filter-tkan-4">
                    <label for="filter-tkan-4">полиэфирнохлопковая</label>
                </li>
                <li>
                    <input type="checkbox" id="filter-tkan-5">
                    <label for="filter-tkan-5">перкаль</label>
                </li>
                <li>
                    <input type="checkbox" id="filter-tkan-6">
                    <label for="filter-tkan-6">сатин-жаккард</label>
                </li>
            </ul>
        </div>
    </div>
    <!-- filter-item -->
    <div class="filter-item">
        <div class="filter-title">Цена</div>
        <div class="filter-content">
            <div class="price">
                <input type="text" class="price-input ui-slider-min" value="0">
                <span class="price-sep"></span>
                <input type="text" class="price-input ui-slider-max" value="2000">
            </div>
            <div class="ui-slider"></div>
            <script>
               $('document').ready(function () {
                  $('.ui-slider').slider({
                     animate: false,
                     range: true,
                     values: [0, 2000],
                     min: 0,
                     max: 2000,
                     step: 1,
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