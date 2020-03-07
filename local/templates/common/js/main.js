$(document).ready(function(){

    //#-href
    $("body").on("click", "a[href^='#']", function(e){
        var id = $(this).attr("href");
        if(id != "#" && $(id).length > 0){
            e.preventDefault();
            $("body,html").animate({"scrollTop": $(id).offset().top}, 1000);
        }
    });
    //end

    //drop-down
    var dropdownContentHeight = 0,
        $dropdownWrap,
        initDropdownContent = ($elem) => {
            /*if ($elem.find(".js-drop_down").length > 0) {
                $elem.find(".js-drop_down").each(function() {
                    initDropdownContent($(this));
                });
            }*/
            $elem.find(".js-drop_down-content").each(function(){
                dropdownContentHeight = $(this).outerHeight();
                if (dropdownContentHeight > 0) {
                    $(this).attr("data-height", dropdownContentHeight);
                    if ($(this).attr("is-active") != "true") {
                        $(this).height(0);
                    } else {
                        var $parent = $(this).parents(".js-drop_down").first();
                        $parent.find(".js-drop_down-btn").first().addClass("active");
                        $(this).addClass("active");
                        $(this).outerHeight($(this).attr("data-height"));
                    }
                }
            })
        };
    $(".js-drop_down").each(function(){
        initDropdownContent($(this));
    });
    $("body").on("click", ".js-drop_down-btn", function(e){
        e.preventDefault();
        var $parent = $(this).closest(".js-drop_down"),
            $content = $parent.find(".js-drop_down-content").first();
        if($parent.length > 0){
            if($(this).hasClass("active")){
                $content.removeClass("active");
                $content.outerHeight(0);
            }
            else{
                $content.addClass("active");
                $content.height($content.attr("data-height"));
            }
        }
        $(this).toggleClass('active');
    });
    $("body").on("click touchstart", function(e){
        if($(e.target).closest(".js-drop_down-btn").length > 0) return;
        if($(e.target).closest(".js-drop_down-content").length > 0) return;
        $(".js-drop_down-content[data-height]:not([is-active='true']):not([data-static])").each(function(){
            $dropdownWrap = $(this).parents(".js-drop_down").first();
            $dropdownWrap.find(".js-drop_down-btn").removeClass("active");
            $dropdownWrap.find(".js-drop_down-content").removeClass("active");
            $dropdownWrap.find(".js-drop_down-content").height(0);
        })
    });
    //end

    //popup
    $("body").on("click", "[data-popup-open]", function(e){
        e.preventDefault();
        var $target = $($(this).attr("data-popup-open"));
        if($target.length > 0){
            $(".popup").hide();
            $("body").css("overflow", "hidden");
            $target.fadeIn();
            if($target[0].hasAttribute("data-animate")){
                $target.find(".popup_content").addClass("animate");
            }
            //dropdown init
            $target.find(".js-drop_down").each(function(){
                $(this).find(".js-drop_down-content").each(function(){
                    if (!$(this)[0].hasAttribute("data-height")) {
                        $(this).attr("data-height", $(this).outerHeight());
                        $(this).height(0);
                    }
                })
            })
            //end
        }
    });
    $("body").on("click", "[data-popup-close]", function(e){
        e.preventDefault();
        var $popup = $(this).parents(".popup").first();
        $("body").css("overflow", "auto");
        $popup.hide();
        $popup.find(".popup_content").removeClass("animate");
    });
    $("body").on("click touchstart", function(e){
        if($(e.target).closest(".js-popup_content").length > 0) return;
        if($(e.target).closest("[data-popup-open]").length > 0) return;
        $("body").css("overflow", "auto");
        $(".popup .popup_content").removeClass("animate");
        $(".popup").hide();
    });
    //end

    //toggle class
    $("body").on("click", ".js-toggle_class", function(e){
        e.preventDefault();
        var $target,
            className = $(this).attr("data-class");

        $target = $(this).attr("data-is_parent") == "true"
            ? $(this).closest($(this).attr("data-target"))
            : $($(this).attr("data-target"));
        if (!$target) {
            return;
        }
        if ($target.hasClass(className)) {
            $target.removeClass(className);
            $(this).removeClass(className);
        } else {
            $target.addClass(className);
            $(this).addClass(className);
        }
    });
    //end

    //markable
    $(".js-markable > a").hover(
        function() {
            var $parent = $(this).parent(),
                value = $(this).attr("data-value");

            if (parseInt(value) > 0 && $parent.length > 0) {
                $parent.find("a").each(function() {
                    if ($(this).attr("data-value") <= value) {
                        $(this).addClass("active");
                    }
                });
            }
        },
        function() {
            var $parent = $(this).parent(),
                value = !!$parent.attr("data-value") ? $parent.attr("data-value") : 0;

            if (!$parent.hasClass("active")) {
                $parent.find("a").each(function() {
                    if ($(this).attr("data-value") > value) {
                        $(this).removeClass("active");
                    }
                });
            }
        }
    );
    $(".js-markable > a").on("click", function(e) {
        e.preventDefault();

        var $parent = $(this).parent(),
            value = $(this).attr("data-value");

        if (parseInt(value) > 0 && $parent.length > 0) {
            $parent.find("a").each(function() {
                if ($(this).attr("value") <= value) {
                    $(this).addClass("active");
                }
            });
            if (!!$parent.attr("data-target")) {
                $($parent.attr("data-target")).val(value);
            }
            $parent.attr("data-value", value);
        }
    });
    //end

    //range-input
    $("body").on("change", ".js-filter-range-value", function(){
        var target = $(this).attr("data-target");

        if($(target).length > 0){
            $(target).val($(this).val());
            $(target).attr("value", $(this).val());
            $(target).change();
        }
    });

    $("body").on("input", ".js-filter-range-value", function(){
        var parentBlock = $(this).parent();

        $displayBlock = parentBlock.find(".js-filter-range-display");
        if($displayBlock.length > 0){
            if(!!$displayBlock.attr("data-mask")){
                $displayBlock.html($displayBlock.attr("data-mask").replace("X", number_format($(this).val(), ".", "")));
            }
            else{
                $displayBlock.text(number_format($(this).val(), ".", ""));
            }
        }
    });

    $(".js-range").each(function(){
        var $this = $(this),
            step = parseFloat($this.attr("data-step")),
            thisOb = $this.get(0),
            minValue = parseFloat($this.attr("data-min")),
            maxValue = parseFloat($this.attr("data-max")),
            curMinValue = parseFloat($this.attr("data-cur_min")),
            curMaxValue = parseFloat($this.attr("data-cur_max")),
            $minTarget = $($this.attr("data-target_min")),
            $maxTarget = $($this.attr("data-target_max")),
            $displayBlock = $this.parent().find(".js-filter-range-display");

        noUiSlider.create(thisOb, {
            start: [curMinValue, curMaxValue],
            step: (step > 0 ? step : 10),
            connect: true,
            range: {
                'min': minValue,
                'max': maxValue
            }
        });
        thisOb.noUiSlider.on("change", function(arValues){
            //$displayBlock.html($displayBlock.attr("data-mask").replace("X", number_format(arValues[0], ".", "")).replace("Y", number_format(arValues[1], ".", "")));
            $minTarget.attr("value", arValues[0]);
            $maxTarget.attr("value", arValues[1]);
            $maxTarget.keyup();
        })
        thisOb.noUiSlider.on("slide", function(arValues){
            $minTarget.attr("value", arValues[0]);
            $maxTarget.attr("value", arValues[1]);
            //$displayBlock.html($displayBlock.attr("data-mask").replace("X", number_format(arValues[0], ".", "")).replace("Y", number_format(arValues[1], ".", "")));
        });
    });
    //end

    //input masks
    $('input[type=tel]').mask('+7 (999) 999-9999');
    //end

    //custom
    $('.js-catalog_filter').on('click', function(e) {
        e.preventDefault();
        if (!$(this).hasClass('active')) {
            $('.catalog_list').removeClass('col-lg-24');
            $('.catalog_list').addClass('col-lg-18');
            $('.catalog_list').removeClass('filter_inctive');
            $(this).text('Скрыть фильтры');
            obSlider.destroy('.catalog_list-content');
        } else {
            $('.catalog_list').addClass('col-lg-24');
            $('.catalog_list').removeClass('col-lg-18');
            $('.catalog_list').addClass('filter_inctive');
            $(this).text('Показать фильтры');
            obSlider.init('.catalog_list-content');
        }
    });
    setTimeout(function () {
        $('.js-catalog_filter').trigger('click');
    }, 1000);

    $('body').on('click', '.js-basket-step input', function() {
        var $rootWrap = $(this).closest('.js-basket-step').parent();

        $rootWrap.find('.js-basket-step').removeClass('active');
        $(this).closest('.js-basket-step').addClass('active');
    });
    //end

    //modules
    if(typeof(obSlider) == "object"){
        obSlider.init();
    }
    if(typeof(obTabs) == "object"){
        obTabs.init();
    }
    //end

    //BX loading
    BX.ready(function(){
        BX.showWait=function(a){
            BX.lastNode=a;
            BX.addClass(BX(a),"loading");
        };
        BX.closeWait=function(a){
            if(!a){
                a=BX.lastNode
            }
            BX.removeClass(BX(a),"loading");
        }
    });
    //end

});
