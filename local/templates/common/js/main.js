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
        $(".js-drop_down-content[data-height]:not([is-active='true'])").each(function(){
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
                $target.find(".popup-content").addClass("animate");
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
        $popup.find(".popup-content").removeClass("animate");
    });
    $("body").on("click touchstart", function(e){
        if($(e.target).closest(".js-popup_content").length > 0) return;
        if($(e.target).closest("[data-popup-open]").length > 0) return;
        $("body").css("overflow", "auto");
        $(".popup .popup-content").removeClass("animate");
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

    //gallery
    $("body").on("mouseover", ".js-gallery_item", function(){
        $(this).find(".animate-start").addClass("animate");
    });
    $("body").on("mouseout", ".js-gallery_item", function(){
        $(this).find(".animate-start").removeClass("animate");
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

    //TODO убрать после доработки
    $('.product_preview-nav').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        arrows: false,
        dots: false,
        vertical: true,
        asNavFor: '.product_preview-img_big'
    });

    $('.product_preview-img_big').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        dots: false,
        asNavFor: '.product_preview-nav',
        autoplay: false,
        focusOnSelect: true,
        infinite: false
    });
    //end

})
