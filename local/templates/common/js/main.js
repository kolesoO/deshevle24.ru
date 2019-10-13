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
        $dropdownWrap;
    $(".js-drop_down").each(function(){
        $(this).find(".js-drop_down-content").each(function(){
            dropdownContentHeight = $(this).outerHeight();
            if (dropdownContentHeight > 0) {
                $(this).attr("data-height", dropdownContentHeight);
                if ($(this).attr("is-active") != "true") {
                    $(this).height(0);
                } else {
                    var $parent = $(this).parents(".js-drop_down").first();
                    $parent.find(".js-drop_down-btn").addClass("active");
                    $parent.find(".js-drop_down-content").addClass("active");
                    $(this).outerHeight($(this).attr("data-height"));
                }
            }
        })
    })
    $("body").on("click", ".js-drop_down-btn", function(e){
        e.preventDefault();
        var $parent = $(this).parents(".js-drop_down").first();
        if($parent.length > 0){
            if($(this).hasClass("active")){
                $parent.find(".js-drop_down-content").removeClass("active");
                $parent.find(".js-drop_down-content").outerHeight(0);
            }
            else{
                $parent.find(".js-drop_down-content").addClass("active");
                $parent.find(".js-drop_down-content").outerHeight($parent.find(".js-drop_down-content").attr("data-height"));
            }
        }
        if($(this).hasClass("active")){
            $(this).removeClass("active");
        }
        else{
            $(this).addClass("active");
        }
    })
    $("body").on("click touchstart", function(e){
        if($(e.target).closest(".js-drop_down-btn").length > 0) return;
        if($(e.target).closest(".js-drop_down-content").length > 0) return;
        $(".js-drop_down-content[data-height]:not([is-active='true'])").each(function(){
            $dropdownWrap = $(this).parents(".js-drop_down").first();
            $dropdownWrap.find(".js-drop_down-btn").removeClass("active");
            $dropdownWrap.find(".js-drop_down-content").removeClass("active");
            $dropdownWrap.find(".js-drop_down-content").height(0);
        })
    })
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
    })
    $("body").on("click", "[data-popup-close]", function(e){
        e.preventDefault();
        var $popup = $(this).parents(".popup").first();
        $("body").css("overflow", "auto");
        $popup.hide();
        $popup.find(".popup-content").removeClass("animate");
    })
    $("body").on("click touchstart", function(e){
        if($(e.target).closest(".js-popup_content").length > 0) return;
        if($(e.target).closest("[data-popup-open]").length > 0) return;
        $("body").css("overflow", "auto");
        $(".popup .popup-content").removeClass("animate");
        $(".popup").hide();
    })
    //end

    //toggle class
    $("body").on("click", ".js-toggle_class", function(e){
        e.preventDefault();
        var $target = $($(this).attr("data-target")),
            className = $(this).attr("data-class");
        if ($target.hasClass(className)) {
            $target.removeClass(className);
            $(this).removeClass(className);
        } else {
            $target.addClass(className);
            $(this).addClass(className);
        }
    })
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

})