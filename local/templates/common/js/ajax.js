var obAjax = {

    params: {},

    /**
     *
     * @param _params
     */
    setParams: function(_params)
    {
        this.params = (_params ? _params : {});
    },

    /**
     *
     * @param obData
     * @returns {string}
     */
    serializeData: function(obData, prefixKey)
    {
        var return_str = "",
            hasPrefix = !!prefixKey;

        if(Object.keys(obData).length > 0){
            for(var i in obData){
                if (hasPrefix) {
                    i = prefixKey + "[" + i + "]";
                }
                if(typeof obData[i] == "object"){
                    for(var j in obData[i]){
                        if(typeof obData[i][j] == "object"){
                            for(var k in obData[i][j]){
                                if(typeof obData[i][j][k] == "object"){
                                    for(var l in obData[i][j][k]){
                                        if (return_str.length > 0) {
                                            return_str += "&";
                                        }
                                        return_str += i + "[" + j + "][" + k + "][" + l + "]=" + obData[i][j][k][l];
                                    }
                                } else {
                                    if (return_str.length > 0) {
                                        return_str += "&";
                                    }
                                    return_str += i + "[" + j + "][" + k + "]=" + obData[i][j][k];
                                }
                            }
                        } else {
                            if (return_str.length > 0) {
                                return_str += "&";
                            }
                            return_str += i + "[" + j + "]=" + obData[i][j];
                        }
                    }
                } else{
                    if (return_str.length > 0) {
                        return_str += "&";
                    }
                    return_str += i + "=" + obData[i];
                }
            }
        }

        return return_str;
    },

    /**
     *
     * @param form
     */
    getFormObject: function(form)
    {
        var values = {},
            inputs = form.elements;

        for (var i = 0; i < inputs.length; i++) {
            if (inputs[i].name.length > 0) {
                values[inputs[i].name] = inputs[i].value;
            }
        }

        return values;
    },

    /**
     *
     * @param iconClass
     * @param msg
     */
    addPopupMessage: function(iconClass, msg)
    {
        var id = "system-popup",
            node = document.createElement("div"),
            childNode = document.createElement("i"),
            oldNode = document.getElementById(id);

        if (oldNode) {
            oldNode.remove();
        }

        node.id = id;
        node.classList.add("system-popup");

        childNode.classList.add("icon", iconClass);
        node.appendChild(childNode);

        childNode = document.createElement("span");
        childNode.innerText = msg;
        node.appendChild(childNode);

        document.body.appendChild(node);

        setTimeout(function(){
            node.classList.add("active");
        }, 100);
        setTimeout(function(){
            node.remove();
        }, 3000);
    },

    /**
     *
     * @param offerId
     * @param priceId
     * @param evt
     */
    addToBasket: function(offerId, priceId, evt)
    {
        evt.preventDefault();

        var ctx = this,
            $qntTarget = $($(evt.target).attr("data-qnt-target")),
            newParams = {
                offer_id: typeof offerId != "object" ? [offerId] : offerId,
                price_id: priceId
            };
        //fix
        if ($qntTarget.length <= 0) {
            $qntTarget = $($(evt.target).closest("a").attr("data-qnt-target"));
        }
        //end fix
        if ($qntTarget.length > 0) {
            newParams.qnt = $qntTarget.val();
        }
        ctx.setParams(newParams);
        ctx.doRequest(
            "POST",
            location.href,
            ctx.serializeData({
                class: "Basket",
                method: "add",
                params: ctx.params
            }),
            [
                ["Content-type", "application/x-www-form-urlencoded"]
            ]
        );
    },

    /**
     *
     * @param data
     */
    addToBasketCallBack: function(data)
    {
        if (!!data.msg) {
            this.addPopupMessage("empty", data.msg);
        }
        BX.onCustomEvent('OnBasketChange');
    },

    /**
     *
     * @param itemId
     * @param offerId
     */
    getFastProduct(itemId, offerId)
    {
        var ctx = this;

        ctx.setParams({
            target_id: "fast-product-content",
            offer_id: offerId
        });
        ctx.doRequest(
            "POST",
            location.href,
            ctx.serializeData({
                class: "Catalog",
                method: "getFastProduct",
                params: {
                    itemId: itemId,
                    offerId: offerId
                }
            }),
            [
                ["Content-type", "application/x-www-form-urlencoded"]
            ]
        );
    },

    /**
     *
     * @param data
     */
    getFastProductCallBack: function(data)
    {
        var targetNode = document.getElementById(this.params.target_id);
        if (!!data.html && !!targetNode) {
            targetNode.innerHTML = data.html;
            obSlider.init('#' + this.params.target_id);
            window['obCatalogElement_' + this.params.offer_id].initFavoriteNode();
            window['obCatalogElement_' + this.params.offer_id].initFavorite(false);
        }
    },

    /**
     *
     * @param offerId
     * @param evt
     */
    addToFavorite: function(offerId, evt)
    {
        evt.preventDefault();

        var ctx = this;
        ctx.doRequest(
            "POST",
            location.href,
            ctx.serializeData({
                class: "Favorite",
                method: "add",
                params: {
                    offer_id: offerId
                }
            }),
            [
                ["Content-type", "application/x-www-form-urlencoded"]
            ]
        );
    },

    /**
     *
     * @param data
     */
    addToFavoriteCallBack: function(data)
    {
        if (typeof data.full_count != "undefined") {
            var favoriteNode = document.getElementById("favorite-wrapper");
            if (!!favoriteNode) {
                favoriteNode.innerHTML = (data.full_count > 0 ? '<span class="icon-inner">' + data.full_count + '</span>' : '');
            }
        }
        if (!!data.msg) {
            this.addPopupMessage("empty", data.msg);
        }
    },

    /**
     *
     * @param offerId
     * @param wrapId
     * @param evt
     */
    deleteFromFavorite: function(offerId, wrapId, evt)
    {
        evt.preventDefault();

        this.setParams({wrap_id: wrapId});
        this.doRequest(
            "POST",
            location.href,
            this.serializeData({
                class: "Favorite",
                method: "delete",
                params: {
                    offer_id: offerId
                }
            }),
            [
                ["Content-type", "application/x-www-form-urlencoded"]
            ]
        );
    },

    /**
     *
     * @param data
     */
    deleteFromFavoriteCallBack: function(data)
    {
        var node = null;

        if (!!data.msg) {
            this.addPopupMessage("empty", data.msg);
        }
        if (typeof data.full_count != "undefined") {
            var node = document.getElementById("favorite-wrapper");
            if (!!node) {
                node.innerHTML = (data.full_count > 0 ? '<span class="icon-inner">' + data.full_count + '</span>' : '');
            }
        }
        this.getFavoriteList(this.params.wrap_id);
        if (!!data.deleted_item) {
            window['obCatalogElement_' + data.deleted_item].initFavoriteNode();
            window['obCatalogElement_' + data.deleted_item].initFavorite(false);
        }
    },

    /**
     *
     * @param targetId
     */
    removeAllFavorite: function(targetId)
    {
        this.setParams({wrap_id: targetId});
        this.doRequest(
            "POST",
            location.href,
            this.serializeData({
                class: "Favorite",
                method: "removeAll",
                params: {}
            }),
            [
                ["Content-type", "application/x-www-form-urlencoded"]
            ]
        );
    },

    /**
     *
     * @param data
     */
    removeAllFavoriteCallBack: function(data)
    {
        if (typeof data.full_count != "undefined") {
            var favoriteNode = document.getElementById("favorite-wrapper");
            if (!!favoriteNode) {
                favoriteNode.innerHTML = (data.full_count > 0 ? '<span class="icon-inner">' + data.full_count + '</span>' : '');
            }
        }
        if (!!data.msg) {
            this.addPopupMessage("empty", data.msg);
        }
        if (!!data.deleted_list) {
            for (var counter in data.deleted_list) {
                window['obCatalogElement_' + data.deleted_list[counter]].initFavoriteNode();
                window['obCatalogElement_' + data.deleted_list[counter]].initFavorite(false);
            }
        }
        this.getFavoriteList(this.params.wrap_id);
    },

    /**
     *
     * @param targetId
     */
    getFavoriteList: function(targetId)
    {
        this.setParams({target_id: targetId});
        this.doRequest(
            "POST",
            location.href,
            this.serializeData({
                class: "Favorite",
                method: "getList",
                params: {}
            }),
            [
                ["Content-type", "application/x-www-form-urlencoded"]
            ]
        );
    },

    /**
     *
     * @param data
     */
    getFavoriteListCallBack: function(data)
    {
        var node = document.getElementById(this.params.target_id);

        if (!!node) {
            node.innerHTML = data.html;
        }
    },

    /**
     *
     * @param targetId
     * @param evt
     */
    getVideo: function(targetId, evt)
    {
        var path = evt.target.getAttribute('data-path');

        if (!!path) {
            alert('video loading');
        }
    },

    /**
     *
     * @param form
     */
    createReview: function(form)
    {
        var ctx = this,
            formData = new FormData(form);

        formData.append('params[js_callback]', 'createReviewCallback');
        formData.append('params[msg_code]', 'REVIEW_CREATED_MSG');
        ctx.doRequest(
            "POST",
            location.href,
            formData,
            []
        );
    },

    /**
     *
     * @param data
     */
    createReviewCallback: function(data)
    {
        if (!!data.msg) {
            this.addPopupMessage("empty", data.msg);
        }
    },

    /**
     *
     * @param wrapId
     * @param offerId
     */
    getReviews: function(wrapId, offerId)
    {
        var ctx = this;

        ctx.setParams({
            target_id: wrapId,
        });
        ctx.doRequest(
            "POST",
            location.href,
            ctx.serializeData({
                class: "Component",
                method: "getReviews",
                params: {
                    offer_id: offerId
                }
            }),
            [
                ["Content-type", "application/x-www-form-urlencoded"]
            ]
        );
    },

    /**
     *
     * @param data
     */
    getReviewsCallBack: function(data)
    {
        if (!!data.html) {
            document.getElementById(this.params.target_id).innerHTML = data.html;
        }
    },

    /**
     *
     * @param method
     * @param url
     * @param sendData
     * @param arHeaders
     */
    doRequest: function(method, url, sendData, arHeaders)
    {
        var ctx = this,
            ObXhttp = new XMLHttpRequest(),
            arHeaders = this.getHeaders(arHeaders),
            obResponse = null,
            targetBlock = document.getElementById(ctx.params.target_id);

        ObXhttp.open(method, url, true);
        ObXhttp.onloadstart = function() {
            BX.showWait(targetBlock);
        };
        ObXhttp.onloadend = function() {
            BX.closeWait(targetBlock);
        };
        ObXhttp.onload = function() {
            obResponse = JSON.parse(ObXhttp.responseText);
            if(!!obResponse.answer.js_callback && typeof ctx[obResponse.answer.js_callback] == "function") {
                ctx[obResponse.answer.js_callback](obResponse.answer);
            } else if (!!targetBlock) {
                targetBlock.innerHTML = obResponse.answer.html;
            }
        };
        //заголовки
        if (Object.keys(arHeaders).length > 0) {
            for(var headerKey in arHeaders) {
                ObXhttp.setRequestHeader(headerKey, arHeaders[headerKey] + "");
            }
        }
        //end
        ObXhttp.send(sendData);
    },

    /**
     *
     * @param arHeaders
     */
    getHeaders: function(arHeaders)
    {
        var obReturn = {};
        if (arHeaders.length > 0) {
            for (var counter in arHeaders) {
                if (arHeaders[counter].length == 2) {
                    obReturn[arHeaders[counter][0]] = arHeaders[counter][1];
                }
            }
        }

        return Object.assign(obReturn, this.getDefaultHeaders());
    },

    /**
     *
     * @returns {{"X-Requested-With": string}}
     */
    getDefaultHeaders: function()
    {
        return {
            "X-Requested-With": "xmlhttprequest"
        };
    }
}
