var obTabs = {

    defWrapperTarget: "body",

    defTabTarget: ".js-tabs",

    /**
     *
     * @param strWrapper
     */
    init: function(strWrapper){

        var ctx = this;

        if(!strWrapper) strWrapper = ctx.defWrapperTarget;
        $(strWrapper).find(ctx.defTabTarget).each(function(){
            ctx.initBtns($(this).find("[data-tab_target]"));
            ctx.initContent($(this).find("[data-tab_content] [data-tab_item]"));
            $(this).addClass('first-btn-clicked');
        });
        ctx.initEvents();

    },

    /**
     *
     * @param $arCollection
     */
    initBtns: function($arCollection){

        $arCollection.removeClass("active");
        $arCollection.first().addClass("active");

    },

    /**
     *
     * @param $arCollection
     */
    initContent: function($arCollection){

        $arCollection.hide();
        $arCollection.first().fadeIn();

    },

    /**
     *
     */
    initEvents: function(){

        var ctx = this;

        $(ctx.defTabTarget).on("click", "[data-tab_target]", function(e){
            ctx.tabClickCallBack(e, this);
        });

    },

    /**
     *
     * @param evt
     * @param self
     */
    tabClickCallBack: function(evt, self){

        evt.preventDefault();

        var ctx = this,
            $wrap = $(self).parents(ctx.defTabTarget).first(),
            $target = $($(self).attr("data-tab_target")),
            fullCount = $wrap.find("[data-tab_target]").length;

        $wrap.find("[data-tab_target]").removeClass("active");
        $wrap.find("[data-tab_content] [data-tab_item]").hide();
        $(self).addClass("active");
        $wrap.removeClass('first-btn-clicked');
        $wrap.removeClass('last-btn-clicked');
        if ($(self).index() === fullCount - 1) {
            $wrap.addClass('last-btn-clicked');
        } else if ($(self).index() === 0) {
            $wrap.addClass('first-btn-clicked');
        }
        $target.fadeIn();

    }

}
