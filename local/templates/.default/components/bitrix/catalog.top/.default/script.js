(function(window){
    'use strict';
    window.catalogElement = function(obParams)
    {
        this.params = obParams;
        this.initFavoriteNode();
        this.initCompareNode();
    };

    window.catalogElement.prototype = {
        initFavoriteNode: function()
        {
            this.arFavorite = document.querySelectorAll('[data-entity="favorite"][data-id="' + this.params.ITEM_ID + '"]');
        },
        initCompareNode: function()
        {
            this.arCompare = document.querySelectorAll('[data-entity="compare"][data-id="' + this.params.OFFER_ID + '"]');
        },
        /**
         *
         * @param flag
         */
        initCompare: function(flag)
        {
            if (!!this.arCompare) {
                var text = BX.message("COMPARE_TITLE"),
                    key = 0;
                if (flag) {
                    text = BX.message("BTN_MESSAGE_COMPARE_REDIRECT");
                    for (key = 0; key < this.arCompare.length; key ++) {
                        this.arCompare[key].href = this.params.compare.COMPARE_PATH;
                    }
                } else {
                    var ctx = this;
                    for (key = 0; key < this.arCompare.length; key ++) {
                        this.arCompare[key].addEventListener("click", function() {
                            BX.ajax({
                                method: 'POST',
                                dataType: 'json',
                                url: ctx.params.compare.COMPARE_PATH + "?action=ADD_TO_COMPARE_LIST&ajax_action=Y&id=" + ctx.params.OFFER_ID,
                                onsuccess: function(response) {
                                    ctx.doCompareCallBack(response);
                                }
                            });
                        });
                    }
                }
                for (key = 0; key < this.arCompare.length; key ++) {
                    this.arCompare[key].querySelector("span").innerHTML = text;
                }
            }
        },

        /**
         *
         * @param flag
         */
        initFavorite: function(flag)
        {
            if (!!this.arFavorite) {
                var iconClass = 'icon-like',
                    ctx = this,
                    key = 0,
                    iconNode = null;
                if (flag) {
                    iconClass = 'icon-favorite-full';
                    for (key = 0; key < this.arFavorite.length; key ++) {
                        ctx.arFavorite[key].href = "/favorite/";
                    }
                } else {
                    for (key = 0; key < this.arFavorite.length; key ++) {
                        ctx.arFavorite[key].addEventListener("click", function(event) {
                            ctx.initFavorite(true);
                            obAjax.addToFavorite(this.getAttribute("data-id"), event);
                        });
                    }
                }
                for (key = 0; key < this.arFavorite.length; key ++) {
                    iconNode = this.arFavorite[key].querySelector('i');
                    if (!!iconNode) {
                        iconNode.classList.remove('icon-like', 'opacity');
                        iconNode.classList.add(iconClass);
                    }
                }
            }
        },

        /**
         *
         * @param resp
         */
        doCompareCallBack: function(resp)
        {
            if (!resp.STATUS) {
                resp.STATUS = "FAIL";
            }
            if (!!resp.MESSAGE) {
                obAjax.addPopupMessage("compare-white", resp.MESSAGE);
            }
            this.initCompare(resp.STATUS == "OK");
        }
    }
})(window);
