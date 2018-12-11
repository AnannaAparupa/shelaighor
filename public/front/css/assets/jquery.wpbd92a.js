function replaceUrlParam(e,r,a){var n=new RegExp("("+r+"=).*?(&|$)"),c=e;return c=e.search(n)>=0?e.replace(n,"$1"+a+"$2"):c+(c.indexOf("?")>0?"&":"?")+r+"="+a};
if ((typeof Shopify) === 'undefined') { Shopify = {}; }
if (!Shopify.formatMoney) {
  	Shopify.formatMoney = function(cents, format) {
    	var value = '',
        	placeholderRegex = /\{\{\s*(\w+)\s*\}\}/,
        	formatString = (format || this.money_format);
    	if (typeof cents == 'string') {
      		cents = cents.replace('.','');
    	}
    	function defaultOption(opt, def) {
      		return (typeof opt == 'undefined' ? def : opt);
    	}
    	function formatWithDelimiters(number, precision, thousands, decimal) {
      		precision = defaultOption(precision, 2);
      		thousands = defaultOption(thousands, ',');
      		decimal   = defaultOption(decimal, '.');
	      	if (isNaN(number) || number == null) {
	        	return 0;
	      	}
	      	number = (number/100.0).toFixed(precision);
	      	var parts   = number.split('.'),
	          	dollars = parts[0].replace(/(\d)(?=(\d\d\d)+(?!\d))/g, '$1' + thousands),
	          	cents   = parts[1] ? (decimal + parts[1]) : '';
	      	return dollars + cents;
    	}
    	switch(formatString.match(placeholderRegex)[1]) {
      		case 'amount':
        		value = formatWithDelimiters(cents, 2);
        		break;
      		case 'amount_no_decimals':
        		value = formatWithDelimiters(cents, 0);
        		break;
      		case 'amount_with_comma_separator':
        		value = formatWithDelimiters(cents, 2, '.', ',');
        		break;
      		case 'amount_no_decimals_with_comma_separator':
        		value = formatWithDelimiters(cents, 0, '.', ',');
        		break;
    	}
    	return formatString.replace(placeholderRegex, value);
  	};
}
Shopify.optionsMap = {};
Shopify.updateOptionsInSelector = function(selectorIndex) {
    switch (selectorIndex) {
        case 0:
            var key = 'root';
            var selector = jQuery('.single-option-selector:eq(0)');
            break;
        case 1:
            var key = jQuery('.single-option-selector:eq(0)').val();
            var selector = jQuery('.single-option-selector:eq(1)');
            break;
        case 2:
            var key = jQuery('.single-option-selector:eq(0)').val();  
            key += ' / ' + jQuery('.single-option-selector:eq(1)').val();
            var selector = jQuery('.single-option-selector:eq(2)');
    }
    var initialValue = selector.val();
    selector.empty();    
    var availableOptions = Shopify.optionsMap[key];
    for (var i=0; i<availableOptions.length; i++) {
        var option = availableOptions[i];
        var newOption = jQuery('<option></option>').val(option).html(option);
        selector.append(newOption);
    }
    jQuery('.swatch[data-option-index="' + selectorIndex + '"] .swatch-element').each(function() {
        if (jQuery.inArray($(this).attr('data-value'), availableOptions) !== -1) {
            $(this).removeClass('soldout').show().find(':radio').removeAttr('disabled','disabled').removeAttr('checked');
        }
        else {
            $(this).addClass('soldout').hide().find(':radio').removeAttr('checked').attr('disabled','disabled');
        }
    });
    if (jQuery.inArray(initialValue, availableOptions) !== -1) {
        selector.val(initialValue);
    }
    selector.trigger('change');  
};
Shopify.linkOptionSelectors = function(product) {
    // Building our mapping object.
    for (var i=0; i<product.variants.length; i++) {
        var variant = product.variants[i];
        if (variant.available) {
            // Gathering values for the 1st drop-down.
            Shopify.optionsMap['root'] = Shopify.optionsMap['root'] || [];
            Shopify.optionsMap['root'].push(variant.option1);
            Shopify.optionsMap['root'] = Shopify.uniq(Shopify.optionsMap['root']);
            // Gathering values for the 2nd drop-down.
            if (product.options.length > 1) {
                var key = variant.option1;
                Shopify.optionsMap[key] = Shopify.optionsMap[key] || [];
                Shopify.optionsMap[key].push(variant.option2);
                Shopify.optionsMap[key] = Shopify.uniq(Shopify.optionsMap[key]);
            }
            // Gathering values for the 3rd drop-down.
            if (product.options.length === 3) {
                var key = variant.option1 + ' / ' + variant.option2;
                Shopify.optionsMap[key] = Shopify.optionsMap[key] || [];
                Shopify.optionsMap[key].push(variant.option3);
                Shopify.optionsMap[key] = Shopify.uniq(Shopify.optionsMap[key]);
            }
        }
    }
    // Update options right away.
    Shopify.updateOptionsInSelector(0);
    if (product.options.length > 1) Shopify.updateOptionsInSelector(1);
    if (product.options.length === 3) Shopify.updateOptionsInSelector(2);
    // When there is an update in the first dropdown.
    jQuery(".single-option-selector:eq(0)").change(function() {
        Shopify.updateOptionsInSelector(1);
        if (product.options.length === 3) Shopify.updateOptionsInSelector(2);
        return true;
    });
    // When there is an update in the second dropdown.
    jQuery(".single-option-selector:eq(1)").change(function() {
        if (product.options.length === 3) Shopify.updateOptionsInSelector(2);
        return true;
    });
};
window.wpb = window.wpb || {};
wpb.cacheSelectors = function () {
  	wpb.cache = {
	    $html                    : $('html'),
	    $body                    : $('body'),
	    $recoverPasswordLink     : $('#RecoverPassword'),
	    $hideRecoverPasswordLink : $('#HideRecoverPasswordLink'),
	    $recoverPasswordForm     : $('#RecoverPasswordForm'),
	    $customerLoginForm       : $('#CustomerLoginForm'),
	    $passwordResetSuccess    : $('#ResetSuccess'),
		$wpbProductImage    	 : $('#ProductPhotoImg'),
      	$wpbNewletterModal    	 : $('#wpbNewsletterModal')
  	};
};
wpb.init = function () {
	FastClick.attach(document.body);
	wpb.cacheSelectors();
	wpb.startTheme();
	wpb.drawersInit();
	wpb.responsiveVideos();
	wpb.loginForms();
	wpb.productThumbImage();
    wpb.accordion();
    wpb.quickview();
    wpb.ajaxFilter();
  	wpb.ajaxSearch();
  	wpb.floatHeader();
  	wpb.productCountdown();
  	wpb.goToTop();
  	wpb.filterByPrice();
    wpb.slickCarousel();
    wpb.owlOneCarousel();
	wpb.instagram();
  	wpb.wpbConfigSection();
  	wpb.menuMobile();
  	wpb.flytocart();
  	wpb.swatchProduct();
    wpb.productLoadMore();
};
wpb.swatchProduct = function() {
	$( ".wpbSwatchProduct > li > label" ).click(function() {
        var newImage = $(this).parent().find('.hidden a').attr('href');
      	if (newImage != '#'){
            $(this).parents('.wpbProBlock').find('.proFeaturedImage img').attr({
                src: newImage
            });
        }
        return false;
    });
}
wpb.drawersInit = function () {
  	//wpb.LeftDrawer = new wpb.Drawers('menuDrawer', 'Left', false);
  	wpb.RightDrawer = new wpb.Drawers('cartDrawer', 'Right', true, {
    	'onDrawerOpen': ajaxCart.load
  	});
};
wpb.getHash = function () {
  	return window.location.hash;
};

wpb.startTheme = function () {
  	$(".swatch :radio").change(function() {
      	var t = $(this).closest(".swatch").attr("data-option-index");
      	var n = $(this).val();
      	$(this).closest("form").find(".single-option-selector").eq(t).val(n).trigger("change")
    });
};
wpb.productLoadMore = function () {
    function loadmoreExecute() {
        var wpbLoadNode = $('.productLoadMore .btnLoadMore');
        var wpbLoadUrl = $('.productLoadMore .btnLoadMore').attr("href");
        $.ajax({
            type: 'GET',
            url: wpbLoadUrl,
            beforeSend: function() {
                $('#loading').show();
            },
            success: function(data) {
                wpbLoadNode.remove();
                $('#loading').hide();
                var filteredData = $(data).find(".producsLoadMore");
                filteredData.insertBefore($(".proLoadMoreBottom"));
                btnMoreEvent();
            },
            dataType: "html"
        });
    }
    function btnMoreEvent(){
        $('.productLoadMore .btnLoadMore').click(function(e){
            if ($(this).hasClass('disableLoadMore')) {
                e.stopPropagation();
                return false;
            }
            else {
                loadmoreExecute();
                e.stopPropagation();
                return false;
            }
        });
    }
    btnMoreEvent();
};
wpb.productPage = function (options) {
	var moneyFormat = options.money_format,
		variant = options.variant,
		selector = options.selector;
	var $addToCart = $('#AddToCart'),
		$productPrice = $('#ProductPrice'),
		$comparePrice = $('#ComparePrice'),
		$quantityElements = $('.qtySelector, label + .wpbJsQty'),
		$addToCartText = $('#AddToCartText');
  	if (variant) {
    	if (variant.available) {
			$addToCart.removeClass('disabled').prop('disabled', false);
			$addToCartText.html("Add to Cart");
			$quantityElements.show();
    	} else {
			$addToCart.addClass('disabled').prop('disabled', true);
			$addToCartText.html("Sold Out");
			$quantityElements.hide();
    	}
    	$productPrice.html( Shopify.formatMoney(variant.price, moneyFormat) );
		if (variant.compare_at_price > variant.price) {
			$comparePrice
			.html(Shopify.formatMoney(variant.compare_at_price, moneyFormat))
			.show();
		} else {
			$comparePrice.hide();
		}
		//if (window.swatch_enable) {
			var form = $('#' + selector.domIdPrefix).closest('form');
	        for (var i=0,length=variant.options.length; i<length; i++) {
	            var radioButton = form.find('.swatch[data-option-index="' + i + '"] :radio[value="' + variant.options[i] +'"]');
	            if (radioButton.size()) {
	                radioButton.get(0).checked = true;
	            }
	        }
		//}
		if (variant.available) {
			$('.productAvailability').removeClass('outstock');
			$('.productAvailability').addClass('instock');
			$('.productAvailability')
			.html('<label>' + "Availability:" + '</label>' + "Many In Stock");
        } else{
        	$('.productAvailability').removeClass('instock');
			$('.productAvailability').addClass('outstock');
        	$('.productAvailability').html('<label>' + "Availability:" + '</label>' + "Unavailable");
        }
  	} else {
	    $addToCart.addClass('disabled').prop('disabled', true);
	    $addToCartText.html("Unavailable");
	    $quantityElements.hide();
  	}
  	if (variant && variant.featured_image) {
        var originalImage = $(".proFeaturedImage img");
        var newImage = variant.featured_image;
        var element = originalImage[0];
        Shopify.Image.switchImage(newImage, element, function (newImageSizedSrc, newImage, element) {
          	$('#productThumbs img').each(function() {
              	var parentThumbImg = $(this).parent();
                var idProductImage = $(this).parent().data("imageid");
              	if (idProductImage == newImage.id) {
                  	$(this).parent().trigger('click');
                  	return false;
                }
            });
        });
    }
};
wpb.responsiveVideos = function () {
  	var $iframeVideo = $('iframe[src*="youtube.com/embed"], iframe[src*="player.vimeo"]');
  	var $iframeReset = $iframeVideo.add('iframe#admin_bar_iframe');
  	$iframeVideo.each(function () {
    	$(this).wrap('<div class="videoContainer"></div>');
  	});
  	$iframeReset.each(function () {
    	this.src = this.src;
  	});
};
wpb.productCountdown = function() {
  	$('[data-countdown]').each(function() {
    	var $this = $(this), finalDate = $(this).data('countdown');
    	$this.countdown(finalDate, function(event) {
    		$this.html(event.strftime(window.countdown_format));
    	});
    });
};
wpb.goToTop = function() {
	$(window).scroll(function() {
        if ($(window).scrollTop() >= 200) {
            $('#goToTop').fadeIn();
        } else {
            $('#goToTop').fadeOut();
        }
    });
    $("#goToTop").click(function(){
        $("body,html").animate({scrollTop:0 },"normal");
        $("#pageContainer").animate({scrollTop:0 },"normal");
            return!1
    });
}
wpb.loginForms = function() {
  	function showRecoverPasswordForm() {
    	wpb.cache.$recoverPasswordForm.show();
    	wpb.cache.$customerLoginForm.hide();
  	}
  	function hideRecoverPasswordForm() {
    	wpb.cache.$recoverPasswordForm.hide();
    	wpb.cache.$customerLoginForm.show();
  	}
	wpb.cache.$recoverPasswordLink.on('click', function(evt) {
		evt.preventDefault();
		showRecoverPasswordForm();
	});
	wpb.cache.$hideRecoverPasswordLink.on('click', function(evt) {
		evt.preventDefault();
		hideRecoverPasswordForm();
	});
	if (wpb.getHash() == '#recover') {
		showRecoverPasswordForm();
	}
};
wpb.resetPasswordSuccess = function() {
	wpb.cache.$passwordResetSuccess.show();
};
wpb.productImage = function(){
	if (wpb.cache.$wpbProductImage.length > 0) {
		if (($(window).width()) >= 992){
	    	//DESKTOP
	    	wpb.cache.$wpbProductImage.elevateZoom({
				zoomType : 'inner',
                gallery: 'productThumbs',
                cursor: 'pointer',
                galleryActiveClass: 'active',
                imageCrossfade: true,
                scrollZoom: true,
                onImageSwapComplete: function() {
                    $(".zoomWrapper div").hide();
                },
                loadingIcon: false
            });
            wpb.cache.$wpbProductImage.bind("click", function(e) {
                var ez = wpb.cache.$wpbProductImage.data('elevateZoom');
                $.fancybox(ez.getGalleryList());
                return false;
            });
	    }
	  	else if (($(window).width()) <= 991){
	  		//TABLET, MOBILE
	  		wpb.cache.$wpbProductImage.elevateZoom({
	  			zoomEnabled: false,
                gallery: 'productThumbs',
                cursor: 'pointer',
                galleryActiveClass: 'active',
                imageCrossfade: false,
                scrollZoom: false,
                onImageSwapComplete: function() {
                    $(".zoomWrapper div").hide();
                },
                loadingIcon: false
            });
            wpb.cache.$wpbProductImage.bind("click", function(e) {
                return false;
            });
	    }
    }
};
wpb.ajaxSearch = function() {
    var currentAjaxRequest = null;
    var searchForms = $('form[action="/search"]').each(function() {
        var inputSearch = $(this).find('input[name="q"]');
        var inputProduct = $(this).find('input[name="type"]');
        var offSet = inputSearch.position().top + inputSearch.innerHeight();
        $('<ul class="wpbAjaxSearch"></ul>')
            .appendTo($(this)).hide();
        if (inputProduct.val() == 'product') {
            inputSearch.attr('autocomplete', 'off').bind('keyup change', function() {
                var term = $(this).val();
                var form = $(this).closest('form');
                var searchURL = '/search?type=product&q=' + term;
                var resultsList = form.find('.wpbAjaxSearch');
                if (term.length > 1 && term != $(this).attr('data-old-term')) {
                    $(this).attr('data-old-term', term);
                  	
                    if (currentAjaxRequest != null) currentAjaxRequest.abort();
                    currentAjaxRequest = $.getJSON(searchURL + '&view=json', function(data) {
                        resultsList.empty();
                        if(data.results_count == 0) {
                            resultsList.hide();
                        } else {
                            $.each(data.results, function(index, item) {
                                var link = $('<a></a>').attr('href', item.url);
                                link.append('<span class="searchProductImage"><img src="' + item.thumbnail + '" /></span>');
                                link.append('<span class="searchProductTitle">' + item.title + '</span>');
                                link.wrap('<li></li>');
                                resultsList.append(link.parent());
                            });
                            if(data.results_count > 10) {
                                resultsList.append('<li><a class="searchViewAll" href="' + searchURL + '">Show all (' + data.results_count + ')</a></li>');
                            }
                            resultsList.fadeIn(200);
                        }        
                    });
                }
            });
        }
    });
    $('body').bind('click', function() {
        $('.wpbAjaxSearch').hide();
    });
};
wpb.floatHeader = function(){
    function doFloatHeader(status){
        if(status){
            $('#wpbHeader').addClass('headerFixed');
            var hideheight =  $('#wpbHeader').height() + 120;
            var pos = $(window).scrollTop();
            if( pos >= hideheight ){
                $('#wpbHeaderMain').addClass('wpbHeaderFixed');
            }else {
                $('#wpbHeaderMain').removeClass('wpbHeaderFixed');
            }
        }
        else{
            $('#wpbHeader').removeClass('headerFixed');
            $('#wpbHeaderMain').removeClass('wpbHeaderFixed');
        }
    }
    function wpbFloatHeader(){
        if (window.float_header){
            if (($(window).width()) >= 992){
                doFloatHeader(true);
            }
            else if (($(window).width()) <= 991){
                doFloatHeader(false)
            }
        }
    }
    function wpbFloatHeaderChange(){
        if (window.float_header){
            if (($(window).width()) >= 992){
                var hideheight =  $('#wpbHeader').height() + 120;
                var pos = $(window).scrollTop();
                if( pos >= hideheight ){
                    $('#wpbHeaderMain').addClass('wpbHeaderFixed');
                }else {
                    $('#wpbHeaderMain').removeClass('wpbHeaderFixed');
                }
            }
            else if (($(window).width()) <= 991){
                $('#wpbHeaderMain').removeClass('wpbHeaderFixed');
            }
        }
    }
    wpbFloatHeader();
    $(window).resize(wpbFloatHeader);
    $(window).scroll(wpbFloatHeaderChange);
};
wpb.productThumbImage = function(){
	if ($("#productThumbs").length > 0) {
		$('#productThumbs .owl-carousel').owlCarousel({
	        items: 4,
            nav: true,
			margin : 10,
            responsive : {
                0: {
                    items:4,
                }
            }
	    });
		$('#productThumbs .slick-carousel').slick({
	        slidesToShow: 5,
            nav: true,
			vertical : true,
			verticalSwiping : true,
			responsive: [
				{
					breakpoint: 768,
					settings: {
						slidesToShow: 4,
						margin : 10,
						vertical: false,
						verticalSwiping : false,
					}
				},
				{
					breakpoint: 480,     
					settings: {
						slidesToShow: 4,
						margin : 10,
						vertical: false,
						verticalSwiping : false,     
					}
				}
			]
	    });		
	}
};
wpb.accordion = function(){
    function accordionSidebar(){
        if ( $(window).width() <= 767){
            if(!$('.wpbSidebar').hasClass('accordion')){
                $('.wpbSidebar .titleSidebar').on('click', function(e){
                    $(this).toggleClass('active').parent().find('.wpbContent').stop().slideToggle('medium');
                  	e.preventDefault();
                });
                $('.wpbSidebar').addClass('accordion').find('.wpbContent').slideUp('fast');
            }
        }
        else {
            $('.wpbSidebar .titleSidebar').removeClass('active').off().parent().find('.wpbContent').removeAttr('style').slideDown('fast');
            $('.wpbSidebar').removeClass('accordion');
        }
    }
    accordionSidebar();
    $(window).resize(accordionSidebar);
};

wpb.ajaxFilter = function(){
    var isAjaxFilterClick =  false;
    if ($(".template-collection")) {
        History.Adapter.bind(window, 'statechange', function() {
            var State = History.getState();
            if (!isAjaxFilterClick) {
                ajaxFilterParams();
                var newurl = ajaxFilterCreateUrl();
                ajaxFilterGetContent(newurl);
                reActivateSidebar();
            }
            wpb.isSidebarAjaxClick = false;
        });
    }
    ajaxFilterParams = function () {
        Shopify.queryParams = {};
        if (location.search.length) {
            for (var aKeyValue, i = 0, aCouples = location.search.substr(1).split('&'); i < aCouples.length; i++) {
                aKeyValue = aCouples[i].split('=');
                if (aKeyValue.length > 1) {
                    Shopify.queryParams[decodeURIComponent(aKeyValue[0])] = decodeURIComponent(aKeyValue[1]);
                }
            }
        }
    }
    ajaxFilterCreateUrl = function(baseLink) {
        var newQuery = $.param(Shopify.queryParams).replace(/%2B/g, '+');
        if (baseLink) {
            if (newQuery != "")
                return baseLink + "?" + newQuery;
            else
                return baseLink;
        }
        return location.pathname + "?" + newQuery;
    }
    ajaxFilterClick = function(baseLink) {
        delete Shopify.queryParams.page;
        var newurl = ajaxFilterCreateUrl(baseLink);
        isAjaxFilterClick = true;
        History.pushState({
            param: Shopify.queryParams
        }, newurl, newurl);
        ajaxFilterGetContent(newurl);
    }
    ajaxFilterSortby = function() {
        if (Shopify.queryParams.sort_by) {
            var sortby = Shopify.queryParams.sort_by;
            $("#SortBy").val(sortby);
        }
        $("li","#SortBy").click(function(event){
			var text_sortby = 	$(this).text();
			$("button","#SortBy").text(text_sortby);
            Shopify.queryParams.sort_by = $(this).data("value");
            ajaxFilterClick();
        });
    }
    ajaxFilterView = function() {
        $(".changeView").click(function(event) {
            event.preventDefault();
            if (!$(this).hasClass("changeViewActive")) {
                if ($(this).data('view') == 'list' ) {
                    Shopify.queryParams.view = "list";
                } else {
                    Shopify.queryParams.view = "grid";
                }
                $(".changeView").removeClass('changeViewActive');
                $(this).addClass('changeViewActive');
                ajaxFilterClick();
            }
        });
    }
    ajaxFilterTags = function(){
        $('.ajaxFilter li > a').click(function(event) {
            event.preventDefault();
            var currentTags = [];
            if (Shopify.queryParams.constraint) {
                currentTags = Shopify.queryParams.constraint.split('+');
            }
            if (!window.sidebar_multichoise && !$(this).parent().hasClass("active")) {
                var otherTag = $(this).parents('.listFilter').find("li.active");
                if (otherTag.length > 0) {
                    var tagName = otherTag.data("filter");
                    if (tagName) {
                        var tagPos = currentTags.indexOf(tagName);
                        if (tagPos >= 0) {
                            currentTags.splice(tagPos, 1);
                        }
                    }
                }
            }
            var dataHandle = $(this).parent().data("filter");
            if (dataHandle) {
                var tagPos = currentTags.indexOf(dataHandle);
                if (tagPos >= 0) {
                    currentTags.splice(tagPos, 1);
                } else {
                    currentTags.push(dataHandle);
                }
            }
            if (currentTags.length) {
                Shopify.queryParams.constraint = currentTags.join('+');
            } else {
                delete Shopify.queryParams.constraint;
            }
            ajaxFilterClick();
        });
    }
    ajaxFilterPaging = function() {
        $('#collPagination .pagination a').click(function(event){
            event.preventDefault();
            var linkPage = $(this).attr("href").match(/page=\d+/g);
            if (linkPage) {
                Shopify.queryParams.page = parseInt(linkPage[0].match(/\d+/g));
                if (Shopify.queryParams.page) {
                    var newurl = ajaxFilterCreateUrl();
                    isAjaxFilterClick = true;
                    History.pushState({
                        param: Shopify.queryParams
                    }, newurl, newurl);
                    ajaxFilterGetContent(newurl);
                    $('body,html').animate({
                        scrollTop: 400
                    }, 600);
                }
            }
        });
    }
    ajaxFilterReview = function() {
        if (window.review){
        	if ($(".shopify-product-reviews-badge").length > 0) {
              	return window.SPR.registerCallbacks(), window.SPR.initRatingHandler(), window.SPR.initDomEls(), window.SPR.loadProducts(), window.SPR.loadBadges();
            };
        }
    }
    ajaxFilterClear = function() {
        $(".ajaxFilter").each(function() {
            var sidebarTag = $(this);
            if (sidebarTag.find(".listFilter > li.active").length > 0) {
                sidebarTag.find(".wpbClear").show().click(function(e) {
                    var currentTags = [];
                    if (Shopify.queryParams.constraint) {
                        currentTags = Shopify.queryParams.constraint.split('+');
                    }
                    sidebarTag.find(".listFilter > li.active").each(function() {
                        var selectedTag = $(this);
                        var tagName = selectedTag.data("filter");
                        if (tagName) {
                            var tagPos = currentTags.indexOf(tagName);
                            if (tagPos >= 0) {
                                currentTags.splice(tagPos, 1);
                            }
                        }
                    });
                    if (currentTags.length) {
                        Shopify.queryParams.constraint = currentTags.join('+');
                    } else {
                        delete Shopify.queryParams.constraint;
                    }
                    ajaxFilterClick();
                    e.preventDefault();
                });
            }
        });
    }
    ajaxFilterClearAll = function() {
        $('.wpbFilter a.wpbClearAll').click(function(e) {
            delete Shopify.queryParams.constraint;
            delete Shopify.queryParams.q;
            ajaxFilterClick();
            e.preventDefault();
        });
    }
    ajaxFilterAddToCart = function(){
      	if (window.ajaxcart_type != "page"){
            ajaxCart.init({
                formSelector: '.formAddToCart',
                cartContainer: '#cartContainer',
                addToCartSelector: '.btnAddToCart',
                cartCountSelector: '.cart-products-count',
                cartCostSelector: '#CartCost',
                moneyFormat: null
            });
        }
    }
    ajaxAccordionMobile = function(){
    	if($('.wpbSidebar').hasClass('accordion')){
            $('#sidebarAjaxFilter .titleSidebar').on('click', function(e){
              	$(this).toggleClass('active').parent().find('.wpbContent').stop().slideToggle('medium');
              	e.preventDefault();
            });
        }
    }
    ajaxFilterData = function(data){
        var currentList = $("#proListCollection .proList");
        var dataList = $(data).find("#proListCollection .proList");
        currentList.replaceWith(dataList);
        if ($(".wpbPagination").length > 0) {
            $(".wpbPagination").replaceWith($(data).find(".wpbPagination"));
        } else {
            $("#proListCollection").append($(data).find(".wpbPagination"));
        }
		$(".countProduct").replaceWith($(data).find(".countProduct"));
        var currentSidebarFilter = $("#sidebarAjaxFilter");
        var dataSidebarFilter = $(data).find("#sidebarAjaxFilter");
        currentSidebarFilter.replaceWith(dataSidebarFilter);
    }
    ajaxFilterGetContent = function(newurl) {
        $.ajax({
            type: 'get',
            url: newurl,
            beforeSend: function() {
                $('#loading').show();
            },
            success: function(data) {
                ajaxFilterData(data);
                ajaxFilterSortby();
                ajaxFilterView();
                ajaxFilterTags();
                ajaxFilterPaging();
				ajaxFilterReview();
                ajaxFilterClear();
                ajaxFilterClearAll();
                $('#loading').hide();
                ajaxFilterAddToCart();
                wpb.quickview();
              	wpb.flytocart();
              	wpb.swatchProduct();
              	ajaxAccordionMobile();
                var newTitle = $(data).filter('title').text();
                document.title = newTitle;
            },
            error: function(xhr, text) {
                $('#loading').hide();

            }
        });
    }
    ajaxFilterParams();
    ajaxFilterSortby();
    ajaxFilterView();
    ajaxFilterTags();
    ajaxFilterPaging();
    ajaxFilterClear();
    ajaxFilterClearAll();
};
wpb.ajaxSearch = function() {
    var currentAjaxRequest = null;
    var searchForms = $('form[action="/search"]').each(function() {
        var input = $(this).find('input[name="q"]');
        var inputProduct = $(this).find('input[name="type"]');
        var offSet = input.position().top + input.innerHeight();
        $('<ul class="wpbAjaxSearch"></ul>')
            .appendTo($(this)).hide();
        if (inputProduct.val() == 'product') {
            input.attr('autocomplete', 'off').bind('keyup change', function() {
                var term = $(this).val();
                var form = $(this).closest('form');
                var searchURL = '/search?type=product&q=' + term;
                var resultsList = form.find('.wpbAjaxSearch');
                if (term.length > 1 && term != $(this).attr('data-old-term')) {
                    $(this).attr('data-old-term', term);
                    if (currentAjaxRequest != null) currentAjaxRequest.abort();
                    currentAjaxRequest = $.getJSON(searchURL + '&view=json', function(data) {
                        resultsList.empty();
                        if(data.results_count == 0) {
                            // resultsList.html('<li><span class="title">No results.</span></li>');
                            // resultsList.fadeIn(200);
                            resultsList.hide();
                        } else {
                            $.each(data.results, function(index, item) {
                                var link = $('<a></a>').attr('href', item.url);
                                link.append('<span class="searchProductImage"><img src="' + item.thumbnail + '" /></span>');
                                link.append('<span class="searchProductTitle">' + item.title + '</span>');
                                link.wrap('<li></li>');
                                resultsList.append(link.parent());
                            });
                            if(data.results_count > 10) {
                                resultsList.append('<li><a class="searchViewAll" href="' + searchURL + '">Show all (' + data.results_count + ')</a></li>');
                            }
                            resultsList.fadeIn(200);
                        }        
                    });
                }
            });
        }
    });
    $('body').bind('click', function() {
        $('.wpbAjaxSearch').hide();
    });
};      
wpb.quickview = function(){
    var product = {};
    var option1 = '';
    var option2 = '';
    Shopify.doNotTriggerClickOnThumb = false;
    selectCallbackQuickView = function(variant, selector) {
        var productItem = jQuery('.jsQuickview .proBoxInfo'),
            addToCart = productItem.find('.btnAddToCart'),
            productPrice = productItem.find('.pricePrimary'),
            comparePrice = productItem.find('.priceCompare');
        if (variant) {
            if (variant.available) {
                addToCart.removeClass('disabled').removeAttr('disabled');
                $(addToCart).find("span").text("Add to Cart");
            } else {
                addToCart.addClass('disabled').attr('disabled', 'disabled');
                $(addToCart).find("span").text("Sold Out");
            }       
            productPrice.html(Shopify.formatMoney(variant.price, window.money));
            if ( variant.compare_at_price > variant.price ) {
                comparePrice
                    .html(Shopify.formatMoney(variant.compare_at_price, window.money)).show();
            } else {
                comparePrice.hide();
            }
            
            if (variant && variant.featured_image) {
                var originalImage = $(".proImageQuickview");
                var newImage = variant.featured_image;
                var element = originalImage[0];
                Shopify.Image.switchImage(newImage, element, function (newImageSizedSrc, newImage, element) {
                    $('.proThumbnails img').each(function() {
                        var parentThumbImg = $(this).parent();
                        var productImage = $(this).parent().data("image");
                        if (newImageSizedSrc.includes(productImage)) {
                            $(this).parent().trigger('click');
                            return false;
                        }
                    });
                });
            }
        } else {
            addToCart.addClass('disabled').attr('disabled', 'disabled');
            $(addToCart).find("span").text("Sold Out");
        }
    }
    changeImageQuickView = function (img, selector) {
        var src = $(img).attr("src");
        src = src.replace("_compact", "");
        $(selector).attr("src", src);
    }
    wpbUpdateOptionsInSelector = function (t) {
        switch (t) {
        case 0:
            var n = "root";
            var r = $(".jsQuickview .single-option-selector:eq(0)");
            break;
        case 1:
            var n = $(".jsQuickview .single-option-selector:eq(0)").val();
            var r = $(".jsQuickview .single-option-selector:eq(1)");
            break;
        case 2:
            var n = $(".jsQuickview .single-option-selector:eq(0)").val();
            n += " / " + $(".jsQuickview .single-option-selector:eq(1)").val();
            var r = $(".jsQuickview .single-option-selector:eq(2)")
        }
        var i = r.val();
        r.empty();
        var s = Shopify.optionsMapQuickview[n];
        if(typeof s != "undefined"){
            for (var o = 0; o < s.length; o++) {
                var u = s[o];
                var a = $("<option></option>").val(u).html(u);
                r.append(a)
            }
        }
        $('.jsQuickview .swatch[data-option-index="' + t + '"] .swatch-element').each(function() {
            if ($.inArray($(this).attr("data-value"), s) !== -1) {
                $(this).removeClass("soldout").show().find(":radio").removeAttr("disabled", "disabled");
            } else {
                //$(this).addClass("soldout").hide().find(":radio").removeAttr("checked").attr("disabled", "disabled")
            }
        });
        if ($.inArray(i, s) !== -1) {
            r.val(i)
        }
        r.trigger("change")
    }
    wpbLinkOptionSelectors = function (t) {
        for (var n = 0; n < t.variants.length; n++) {
            var r = t.variants[n];
            if (r.available) {
                Shopify.optionsMapQuickview["root"] = Shopify.optionsMapQuickview["root"] || [];
                Shopify.optionsMapQuickview["root"].push(r.option1);
                Shopify.optionsMapQuickview["root"] = Shopify.uniq(Shopify.optionsMapQuickview["root"]);
                if (t.options.length > 1) {
                    var i = r.option1;
                    Shopify.optionsMapQuickview[i] = Shopify.optionsMapQuickview[i] || [];
                    Shopify.optionsMapQuickview[i].push(r.option2);
                    Shopify.optionsMapQuickview[i] = Shopify.uniq(Shopify.optionsMapQuickview[i])
                }
                if (t.options.length === 3) {
                    var i = r.option1 + " / " + r.option2;
                    Shopify.optionsMapQuickview[i] = Shopify.optionsMapQuickview[i] || [];
                    Shopify.optionsMapQuickview[i].push(r.option3);
                    Shopify.optionsMapQuickview[i] = Shopify.uniq(Shopify.optionsMapQuickview[i])
                }
            }
        }
        wpbUpdateOptionsInSelector(0);
        if (t.options.length > 1)
            wpbUpdateOptionsInSelector(1);
        if (t.options.length === 3)
            wpbUpdateOptionsInSelector(2);
        $(".single-option-selector:eq(0)").change(function() {
            wpbUpdateOptionsInSelector(1);
            if (t.options.length === 3)
                wpbUpdateOptionsInSelector(2);
            return true
        });
        $(".single-option-selector:eq(1)").change(function() {
            if (t.options.length === 3)
                wpbUpdateOptionsInSelector(2);
            return true
        });
    }
    loadQuickViewSlider = function (n, r) {
        var loadingImgQuickView = $('.loadingImage');
        var s = Shopify.resizeImage(n.featured_image, "grande");
        loadingImgQuickView.hide();
        if (n.images.length > 0) {
            var o = r.find(".proThumbnailsQuickview .owl-carousel");
            for (i in n.images) {
                var u = Shopify.resizeImage(n.images[i], "grande");
                var a = Shopify.resizeImage(n.images[i], "compact");
                var f = '<div class="thumbItem"><a href="javascript:void(0)" data-imageid="' + n.id + '" data-image="' + n.images[i] + '" data-zoom-image="' + u + '" ><img src="' + a + '" alt="Produc Image" /></a></div>';
                o.append(f)
            }
            o.find("a").click(function() {
                var t = r.find(".proImageQuickview");
                if (t.attr("src") != $(this).attr("data-image")) {
                    t.attr("src", $(this).attr("data-image"));
                    loadingImgQuickView.show();
                    t.load(function(t) {
                        $(this).unbind("load");
                        loadingImgQuickView.hide()
                    })
                }
            });
            o.owlCarousel({
                items: 4,
                nav: true,
                responsive : {
                    0: {
                        items:4,
                    }
                }
            }).css("visibility", "visible")
        } else {        
            r.find(".jsQuickview .proThumbnailsQuickview").remove();
        }
    }
    convertToSlug = function (e) {
        return e.toLowerCase().replace(/[^a-z0-9 -]/g, "").replace(/\s+/g, "-").replace(/-+/g, "-")
    }
    addCheckedSwatch = function (){  
        $('.swatch .color label').on('click', function () {      
            $('.swatch .color').each(function(){      
                $(this).find('label').removeClass('checkedBox');
            });
            $(this).addClass('checkedBox');
        });
    }
    quickViewVariantsSwatch = function (t, quickview) {
        if (t.variants.length > 1) {
            for (var r = 0; r < t.variants.length; r++) {
                var i = t.variants[r];
                var s = '<option value="' + i.id + '">' + i.title + "</option>";
                quickview.find("form.formQuickview .proVariantsQuickview > select").append(s)
            }
            new Shopify.OptionSelectors( 'productSelectQuickview', { 
                product: t, 
                onVariantSelected: selectCallbackQuickView
            });
            if (t.options.length == 1) {
                $("form.formQuickview .selector-wrapper:eq(0)").prepend("<label>" + t.options[0].name + "</label>")
            }
            quickview.find("form.formQuickview .selector-wrapper label").each(function(n, r) {
                $(this).html(t.options[n].name)
            })
            
            if (t.available) {
                Shopify.optionsMapQuickview = {};
                wpbLinkOptionSelectors(t);
            }
        }
        else {
            quickview.find("form.formQuickview .proVariantsQuickview > select").remove();
            var v = '<input type="hidden" name="id" value="' + t.variants[0].id + '">';
            quickview.find("form.formQuickview").append(v)
        }
    }
    validateQty = function (qty) {
        if((parseFloat(qty) == parseInt(qty)) && !isNaN(qty)) {

        } else {
            qty = 1;
        }
        return qty;
    };
    $(document).on("click", ".proThumbnailsQuickview li", function() {
        changeImageQuickView($(this).find("img:first-child"), ".proImageQuickview");
    });
    $(document).on('click', '.quickviewClose, .quickviewOverlay', function(e){
        $("#wpbQuickView").fadeOut(500);
        $(".jsQuickview").html("");
        $(".jsQuickview").fadeOut(500);
    });
    $(document).on('click', '.btnProductQuickview', function(e){
        $('#loading').show();
        var producthandle = $(this).data("handle");
        Shopify.getProduct(producthandle,function(product) {
            var qvhtml = $("#quickviewModal").html();
            $(".jsQuickview").html(qvhtml);
            var quickview= $(".jsQuickview");
            var productdes = product.description.replace(/(<([^>]+)>)/ig,"");
            var featured_image = product.featured_image;
            productdes = productdes.split(" ").splice(0,30).join(" ")+"...";
            quickview.find(".proImageQuickview").attr("src",featured_image);
            quickview.find(".pricePrimary").html(Shopify.formatMoney(product.price, window.money));
            quickview.find(".proBoxInfo").attr("id", "product-" + product.id);
            quickview.find(".formQuickview").attr("id", "product-actions-" + product.id);
            quickview.find(".formQuickview select").attr("id", "productSelectQuickview");
            quickview.find(".proBoxInfo .quickviewName").text(product.title);
            quickview.find(".proBoxInfo .quickViewVendor").append("<label>Vendor:</label> " + product.vendor);
            quickview.find(".proBoxInfo .quickViewType").append("<label>Product type:</label> " + product.type);
            if(product.available){
                quickview.find(".proBoxInfo .quickviewAvailability").append("<label>Availability:</label>Many In Stock");
            }else{
                quickview.find(".proBoxInfo .quickviewAvailability").append("Availability:</label>Unavailable");
            }
            quickview.find(".proShortDescription").text(productdes);
            if (product.compare_at_price > product.price) {
                quickview.find(".priceCompare").html(Shopify.formatMoney(product.compare_at_price_max, window.money)).show();
            }
            else {
                quickview.find(".priceCompare").html("");
            }
            if (!product.available) {
                quickview.find("select, input, .dec, .inc").remove();
                quickview.find(".btnAddToCart").text("Sold Out").addClass("disabled").attr("disabled", "disabled");
                $(".proQuantity").css("display", "none");
            }
            else {
                quickViewVariantsSwatch(product, quickview);
            }
            loadQuickViewSlider(product, quickview);
            $('#wpbQuickView').fadeIn(500);
            $('.jsQuickview').fadeIn(500);
            $('#loading').hide();
            $('.wpbQtyAdjust').on('click', function() {
                var $el = $(this),
                    id = $el.data('id'),
                    $qtySelector = $el.siblings('.wpbQtyNum'),
                    qty = parseInt($qtySelector.val().replace(/\D/g, ''));
                var qty = validateQty(qty);
                if ($el.hasClass('wpbQtyAdjustPlus')) {
                    qty += 1;
                } else {
                    qty -= 1;
                    if (qty <= 1) qty = 1;
                }
                $qtySelector.val(qty);
            });
        });
        return false;
    });
};
wpb.Drawers = (function () {
  	var Drawer = function (id, position, iscart, options) {
	    var defaults = {
	      	close: '.jsDrawerClose',
	      	open: '.jsDrawerOpen' + position,
	      	openClass: 'jsDrawerOpen',
	      	dirOpenClass: 'jsDrawerOpen' + position
	    };
	    this.$nodes = {
	      	parent: $('body, html'),
	      	page: $('#pageContainer'),
	      	moved: $('.isMoved')
	    };
	    this.config = $.extend(defaults, options);
	    this.position = position;
        this.iscart = iscart;
	    this.$drawer = $('#' + id);
	    if (!this.$drawer.length) {
	      	return false;
	    }
	    this.drawerIsOpen = false;
	    this.init();
  	};
	Drawer.prototype.init = function () {
		$(this.config.open).on('click', $.proxy(this.open, this));
		this.$drawer.find(this.config.close).on('click', $.proxy(this.close, this));
	};
  	Drawer.prototype.open = function (evt) {
  		if (window.ajaxcart_type == 'modal' && this.iscart ) {
  			var externalCall = false;
  			this.$drawer.modal();//Use modal Bootstrap
  			if (evt) {
	      		evt.preventDefault();
		    } else {
		      	externalCall = true;
		    }
			if (evt && evt.stopPropagation) {
				evt.stopPropagation();
				this.$activeSource = $(evt.currentTarget);
			}
			if (this.config.onDrawerOpen && typeof(this.config.onDrawerOpen) == 'function') {
				if (!externalCall) {
					this.config.onDrawerOpen();
				}
			}
  		} else if (window.ajaxcart_type == 'drawer') {
			var externalCall = false;
  			if (evt) {
	      		evt.preventDefault();
		    } else {
		      	externalCall = true;
		    }
			if (evt && evt.stopPropagation) {
				evt.stopPropagation();
				this.$activeSource = $(evt.currentTarget);
			}
			if (this.drawerIsOpen && !externalCall) {
				return this.close();
			}
	    	this.$nodes.moved.addClass('is-transitioning');
	    	this.$drawer.prepareTransition();
	    	this.$nodes.parent.addClass(this.config.openClass + ' ' + this.config.dirOpenClass);
	    	this.drawerIsOpen = true;
	   		this.trapFocus(this.$drawer, 'drawer_focus');
			if (this.config.onDrawerOpen && typeof(this.config.onDrawerOpen) == 'function') {
				if (!externalCall) {
					this.config.onDrawerOpen();
				}
			}
			if (this.$activeSource && this.$activeSource.attr('aria-expanded')) {
				this.$activeSource.attr('aria-expanded', 'true');
			}
			this.$nodes.page.on('touchmove.drawer', function () {
				return false;
			});
			this.$nodes.page.on('click.drawer', $.proxy(function () {
				this.close();
				return false;
			}, this));
		} else {
            var externalCall = false;
  			if (evt) {
	      		evt.preventDefault();
		    } else {
		      	externalCall = true;
		    }
			if (evt && evt.stopPropagation) {
				evt.stopPropagation();
				this.$activeSource = $(evt.currentTarget);
			}
			if (this.config.onDrawerOpen && typeof(this.config.onDrawerOpen) == 'function') {
				if (!externalCall) {
					this.config.onDrawerOpen();
				}
			}
        }
  	};
  	Drawer.prototype.close = function () {
    	if (!this.drawerIsOpen) { // don't close a closed drawer
      		return;
    	}
    	$(document.activeElement).trigger('blur');
    	this.$nodes.moved.prepareTransition({ disableExisting: true });
    	this.$drawer.prepareTransition({ disableExisting: true });
    	this.$nodes.parent.removeClass(this.config.dirOpenClass + ' ' + this.config.openClass);
    	this.drawerIsOpen = false;
    	this.removeTrapFocus(this.$drawer, 'drawer_focus');
    	this.$nodes.page.off('.drawer');
  	};
	Drawer.prototype.trapFocus = function ($container, eventNamespace) {
		var eventName = eventNamespace ? 'focusin.' + eventNamespace : 'focusin';
		$container.attr('tabindex', '-1');
		$container.focus();
		$(document).on(eventName, function (evt) {
			if ($container[0] !== evt.target && !$container.has(evt.target).length) {
				$container.focus();
			}
		});
	};
	Drawer.prototype.removeTrapFocus = function ($container, eventNamespace) {
		var eventName = eventNamespace ? 'focusin.' + eventNamespace : 'focusin';
		$container.removeAttr('tabindex');
		$(document).off(eventName);
	};
	return Drawer;
})();
wpb.loadingSite = function(){
	$('#loadingSite').fadeOut();
};
wpb.filterByPrice = function(){
  	var $range = $("#rangePrice");
  	var minPrice = 0;
  	var maxPrice = 0;
  	function processFilterPrice(minPrice, maxPrice){
      	$('#loading').show();
    	$("#wpbProList .wpbFlexRow .wpbProBlock").hide().filter(function() {
          	var price = parseInt($(this).data("price"), 10);
          	return price >= minPrice && price <= maxPrice;
        }).show();
      	setTimeout( function() {
        	$('#loading').hide();
        }, 200 );
    };

  	$range.ionRangeSlider({
    	onFinish: function (data) {
			minPrice = $range.data("from");
			maxPrice = $range.data("to");			
            processFilterPrice(minPrice,maxPrice);
        }
    });
};
wpb.menuMobile = function(){
  	$('#btnMenuMobile').on("click", function (e) {
      	e.preventDefault();
      	$('body').toggleClass("menuMobileActive");
    });
  	$('.btnMenuClose').on("click", function (e) {
      	e.preventDefault();
      	$('body').removeClass("menuMobileActive");
    });
};
wpb.slickCarousel = function(){
    $(".slickCarousel").each(function(){
        var slickCarousel = $(this);
        var columnOne = slickCarousel.data("columnone"),
            columnTwo = slickCarousel.data("columntwo"),
            columnThree = slickCarousel.data("columnthree"),
            columnFour = slickCarousel.data("columnfour");
        var config = {
			slidesToShow: columnOne,
			arrows: slickCarousel.data("nav") ? true : false ,
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: columnOne
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: columnTwo
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: columnThree
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: columnFour 
                    }
                }
            ]
        };
		slickCarousel.on('init', function(event, slick){
			wpb.fixSlickDarius(slickCarousel);
		});		
		slickCarousel.on('afterChange', function(event, slick){
			wpb.fixSlickDarius(slickCarousel);
		});
		slickCarousel.slick( config );
    });
};

wpb.fixSlickDarius = function(slickCarousel){
	if(slickCarousel.hasClass("category-radius")){
		var width_element = $(".item",slickCarousel).width();
		$(".item",slickCarousel).css("height", width_element);
	}
};

wpb.owlOneCarousel = function(){
    $(".owlCarouselPlay .owl-carousel").each(function(){
        var owlCarousel = $(this);
		_load_owl_carousel(owlCarousel);
    });
};

wpb.instagram = function(){
	$( ".wpb-instagram" ).each(function() {
		var $element = $(this);
		var value_user_id = $element.data("userid");
		var value_access_token = $element.data("accesstoken");
		var value_limit = $element.data("limit");		
		if (value_user_id && value_access_token) {
			var media_users_recent = "https://api.instagram.com/v1/users/" + value_user_id + "/media/recent?access_token=" + value_access_token + "&count=" + value_limit;
			$.ajax({
				method: "GET",
				dataType: "jsonp",
				cache: false,
				url: media_users_recent,
				success: function (response) {
					var data_image = response.data;
					if (typeof (data_image) == 'undefined') {
						$(".content_instagram",$element).append("<li>"+$element.data("text_check_user")+"</li>");
						return;
					}					
					if (data_image.length > 0) {
						var html = '';
						for (var i = 0; i < data_image.length; i++) {
							if(i < data_image.length){
								html += '<div class="image-instagram">'
										+ '<a class="instagram" target="_blank"  href="' + data_image[i].link + '">'
										+	'<img src="' + data_image[i].images.standard_resolution.url + '" alt="" title="" width="'+$element.data("width")+'" height="'+$element.data("height")+'">' 
										+ '</a>'
										+ '<div class="follow-instagram">'
										+ '<a href="' + data_image[i].link + '">' 
										+ 'Instagram' 
										+ '</a>'
										+ '</div>'
									+'</div>';
							}	
						}					
						$(".content_instagram",$element).html(html);
						_load_owl_carousel($(".owl-carousel",$element));
					}else {
						$(".content_instagram",$element).append("<li>"+$(this).data("text_image_show")+"</li>");
						return;
					}
				},
				error: function () {
					$(".content_instagram",$element).append("<li>"+$(this).data("text_image_show")+"</li>");
				}
			})
		}
	});	
};
wpb.wpbConfigSection = function(){
  	var element = $('#shopify-section-wpb-header');
  	if(element[0].attributes.length == 3) {
    	$('#wpbConfigSection').addClass('showBox');
    }
  	else {
    	$('#wpbConfigSection').empty();
    }
    $('.menuSsWrap .btnConfigSection').on('click', function() {
		$('.menuSsWrap').addClass('active');
    });
  	$('.menuSsWrap .closeMenu').on('click', function() {
		$('.menuSsWrap').removeClass('active');
    });
};
wpb.flytocart = function(){
  	function flyToElement(flyer, flyingTo) {
        var $func = $(this);
        var divider = 3;
        var flyerClone = $(flyer).clone();
        $(flyerClone).css({position: 'absolute', top: $(flyer).offset().top + "px", left: $(flyer).offset().left + "px", opacity: 1, 'z-index': 1000});
        $('body').append($(flyerClone));
        var gotoX = $(flyingTo).offset().left + ($(flyingTo).width() / 2) - ($(flyer).width()/divider)/2;
        var gotoY = $(flyingTo).offset().top + ($(flyingTo).height() / 2) - ($(flyer).height()/divider)/2;

        $(flyerClone).animate({
            opacity: 0.4,
            left: gotoX,
            top: gotoY,
            width: $(flyer).width()/divider,
            height: $(flyer).height()/divider
        }, 700,
        function () {
            $(flyingTo).fadeOut('fast', function () {
                $(flyingTo).fadeIn('fast', function () {
                    $(flyerClone).fadeOut('fast', function () {
                        $(flyerClone).remove();
                    });
                });
            });
        });
    }
    if (window.ajaxcart_type == 'fly') {
      	$('.formAddToCart button.btnAddToCart').on('click', function(e){
			//e.preventDefault();
			$('html, body').animate({
                'scrollTop' : $(".wpbCartTop").position().top
            });
          	var itemImg = $(this).parents('.proFlyBlock').find('.imgFlyCart');
            flyToElement($(itemImg), $('.wpbCartTop'));
		});
    }
};
/* ================ SHOPIFY DEBUT - WPBINGO CUSTOMIZE ================ */
window.wpbtheme = window.wpbtheme || {};
wpbtheme.Sections = function Sections() {
    this.constructors = {};
    this.instances = [];
    $(document)
        .on('shopify:section:load', this._onSectionLoad.bind(this))
        .on('shopify:section:unload', this._onSectionUnload.bind(this))
        .on('shopify:section:select', this._onSelect.bind(this))
        .on('shopify:section:deselect', this._onDeselect.bind(this))
        .on('shopify:block:select', this._onBlockSelect.bind(this))
        .on('shopify:block:deselect', this._onBlockDeselect.bind(this));
};
wpbtheme.Sections.prototype = _.assignIn({}, wpbtheme.Sections.prototype, {
    _createInstance: function(container, constructor) {
        var $container = $(container);
        var id = $container.attr('data-section-id');
        var type = $container.attr('data-section-type');
        constructor = constructor || this.constructors[type];
        if (_.isUndefined(constructor)) {
          	return;
        }
        var instance = _.assignIn(new constructor(container), {
          	id: id,
          	type: type,
          	container: container
        });
        this.instances.push(instance);
    },
    _onSectionLoad: function(evt) {
        var container = $('[data-section-id]', evt.target)[0];
        if (container) {
          	this._createInstance(container);
        }
    },
    _onSectionUnload: function(evt) {
        this.instances = _.filter(this.instances, function(instance) {
            var isEventInstance = (instance.id === evt.detail.sectionId);
            if (isEventInstance) {
                if (_.isFunction(instance.onUnload)) {
                  	instance.onUnload(evt);
                }
            }
          	return !isEventInstance;
        });
    },
    _onSelect: function(evt) {
        // eslint-disable-next-line no-shadow
        var instance = _.find(this.instances, function(instance) {
          	return instance.id === evt.detail.sectionId;
        });
        if (!_.isUndefined(instance) && _.isFunction(instance.onSelect)) {
          	instance.onSelect(evt);
        }
    },
    _onDeselect: function(evt) {
        // eslint-disable-next-line no-shadow
        var instance = _.find(this.instances, function(instance) {
          	return instance.id === evt.detail.sectionId;
        });
        if (!_.isUndefined(instance) && _.isFunction(instance.onDeselect)) {
          	instance.onDeselect(evt);
        }
    },
    _onBlockSelect: function(evt) {
        // eslint-disable-next-line no-shadow
        var instance = _.find(this.instances, function(instance) {
          	return instance.id === evt.detail.sectionId;
        });
        if (!_.isUndefined(instance) && _.isFunction(instance.onBlockSelect)) {
          	instance.onBlockSelect(evt);
        }
    },
    _onBlockDeselect: function(evt) {
        // eslint-disable-next-line no-shadow
        var instance = _.find(this.instances, function(instance) {
          	return instance.id === evt.detail.sectionId;
        });
        if (!_.isUndefined(instance) && _.isFunction(instance.onBlockDeselect)) {
          	instance.onBlockDeselect(evt);
        }
    },
    register: function(type, constructor) {
        this.constructors[type] = constructor;
        $('[data-section-type=' + type + ']').each(function(index, container) {
          	this._createInstance(container, constructor);
        }.bind(this));
    }
});
wpbtheme.Slideshow = (function() {
    this.$slideshow = null;
    var classes = {
        wrapper: 'wpbSlideshowWrapper',
        slideshow: 'slideshow',
        currentSlide: 'slick-current',
        video: 'wpbssVideo',
        videoBackground: 'wpbssVideoBackground',
        closeVideoBtn: 'btnssVideoControlClose',
        pauseButton: 'btnssPause',
        isPaused: 'is-paused'
    };

    function slideshow(el) {
        this.$slideshow = $(el);
        this.$wrapper = this.$slideshow.closest('.' + classes.wrapper);
        this.$pause = this.$wrapper.find('.' + classes.pauseButton);
        this.settings = {
            accessibility: true,
            arrows: true,
            dots: true,
            fade: true,
          	pauseOnHover: true,
            draggable: true,
            touchThreshold: 20,
            autoplay: this.$slideshow.data('autoplay'),
            autoplaySpeed: this.$slideshow.data('speed')
        };
        this.$slideshow.on('beforeChange', beforeChange.bind(this));
        this.$slideshow.on('init', slideshowA11y.bind(this));
        this.$slideshow.slick(this.settings);
    	this.$pause.on('click', this.togglePause.bind(this));
    }
  	function slideshowA11y(event, obj) {
        var $slider = obj.$slider;
        var $list = obj.$list;
        var $wrapper = this.$wrapper;
        var autoplay = this.settings.autoplay;
    	// Remove default Slick aria-live attr until slider is focused
    	$list.removeAttr('aria-live');
    	// When an element in the slider is focused
    	// pause slideshow and set aria-live.
        $wrapper.on('focusin', function(evt) {
          	if (!$wrapper.has(evt.target).length) {
            	return;
          	}
          	$list.attr('aria-live', 'polite');
          	if (autoplay) {
            	$slider.slick('slickPause');
          	}
        });
      	//Resume autoplay
        $wrapper.on('focusout', function(evt) {
            if (!$wrapper.has(evt.target).length) {
              	return;
            }
            $list.removeAttr('aria-live');
            if (autoplay) {
                // Manual check if the focused element was the video close button
                // to ensure autoplay does not resume when focus goes inside YouTube iframe
                if ($(evt.target).hasClass(classes.closeVideoBtn)) {
                  return;
                }
                $slider.slick('slickPlay');
            }
        });
        // Add arrow key support when focused
        if (obj.$dots) {
            obj.$dots.on('keydown', function(evt) {
                if (evt.which === 37) {
                  	$slider.slick('slickPrev');
                }
                if (evt.which === 39) {
                  	$slider.slick('slickNext');
                }
                // Update focus on newly selected tab
                if ((evt.which === 37) || (evt.which === 39)) {
                  	obj.$dots.find('.slick-active button').focus();
                }
            });
        }
  	};
    function beforeChange(event, slick, currentSlide, nextSlide) {
        var $slider = slick.$slider;
        var $currentSlide = $slider.find('.' + classes.currentSlide);
        var $nextSlide = $slider.find('.wpbssSlide[data-slick-index="' + nextSlide + '"]');
        if (isVideoInSlide($currentSlide)) {
            var $currentVideo = $currentSlide.find('.' + classes.video);
            var currentVideoId = $currentVideo.attr('id');
            wpbtheme.SlideshowVideo.pauseVideo(currentVideoId);
            $currentVideo.attr('tabindex', '-1');
        }
        if (isVideoInSlide($nextSlide)) {
            var $video = $nextSlide.find('.' + classes.video);
            var videoId = $video.attr('id');
            var isBackground = $video.hasClass(classes.videoBackground);
            if (isBackground) {
              	wpbtheme.SlideshowVideo.playVideo(videoId);
            } else {
              	$video.attr('tabindex', '0');
            }
        }
    }
    function isVideoInSlide($slide) {
      	return $slide.find('.' + classes.video).length;
    }
    slideshow.prototype.togglePause = function() {
        var slideshowSelector = getSlideshowId(this.$pause);
        if (this.$pause.hasClass(classes.isPaused)) {
          	this.$pause.removeClass(classes.isPaused);
          	$(slideshowSelector).slick('slickPlay');
        } else {
          	this.$pause.addClass(classes.isPaused);
          	$(slideshowSelector).slick('slickPause');
        }
    };
    function getSlideshowId($el) {
      	return '#wpbSlideshows' + $el.data('id');
    }
  	return slideshow;
})();
// Youtube API callback
// eslint-disable-next-line no-unused-vars
function onYouTubeIframeAPIReady() {
  	wpbtheme.SlideshowVideo.loadVideos();
}
wpbtheme.SlideshowVideo = (function() {
    var autoplayCheckComplete = false;
    var autoplayAvailable = false;
    var playOnClickChecked = false;
    var playOnClick = false;
    var youtubeLoaded = false;
    var videos = {};
    var videoPlayers = [];
    var videoOptions = {
    	ratio: 16 / 9,
    	playerVars: {
        	// eslint-disable-next-line camelcase
            iv_load_policy: 3,
            modestbranding: 1,
            autoplay: 0,
            controls: 0,
            showinfo: 0,
            wmode: 'opaque',
            branding: 0,
            autohide: 0,
            rel: 0
        },
        events: {
            onReady: onPlayerReady,
            onStateChange: onPlayerChange
        }
  	};
    var classes = {
        playing: 'video-is-playing',
        paused: 'video-is-paused',
        loading: 'video-is-loading',
        loaded: 'video-is-loaded',
        slideshowWrapper: 'wpbSlideshowWrapper',
        slide: 'wpbssSlide',
        slideBackgroundVideo: 'wpbssSlideBackgroundVideo',
        slideDots: 'slick-dots',
        videoChrome: 'wpbssVideo-chrome',
        videoBackground: 'wpbssVideoBackground',
        playVideoBtn: 'btnssVideoControlPlay',
        closeVideoBtn: 'btnssVideoControlClose',
        currentSlide: 'slick-current',
        slickClone: 'slick-cloned',
        supportsAutoplay: 'autoplay',
        supportsNoAutoplay: 'no-autoplay'
    };
    function init($video) {
        if (!$video.length) {
          	return;
        }

        videos[$video.attr('id')] = {
            id: $video.attr('id'),
            videoId: $video.data('id'),
            type: $video.data('type'),
            status: $video.data('type') === 'chrome' ? 'closed' : 'background', // closed, open, background
            videoSelector: $video.attr('id'),
            $parentSlide: $video.closest('.' + classes.slide),
            $parentSlideshowWrapper: $video.closest('.' + classes.slideshowWrapper),
            controls: $video.data('type') === 'background' ? 0 : 1,
            slideshow: $video.data('slideshow')
        };
        if (!youtubeLoaded) {
            // This code loads the IFrame Player API code asynchronously.
            var tag = document.createElement('script');
            tag.src = 'https://www.youtube.com/iframe_api';
            var firstScriptTag = document.getElementsByTagName('script')[0];
            firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
        }
    }
    function customPlayVideo(playerId) {
        if (!playOnClickChecked && !playOnClick) {
          	return;
        }
        if (playerId && typeof videoPlayers[playerId].playVideo === 'function') {
          	privatePlayVideo(playerId);
        }
    }
    function pauseVideo(playerId) {
        if (videoPlayers[playerId] && typeof videoPlayers[playerId].pauseVideo === 'function') {
          	videoPlayers[playerId].pauseVideo();
        }
    }
    function loadVideos() {
        for (var key in videos) {
            if (videos.hasOwnProperty(key)) {
                var args = $.extend({}, videoOptions, videos[key]);
                args.playerVars.controls = args.controls;
                videoPlayers[key] = new YT.Player(key, args);
            }
        }
        initEvents();
        youtubeLoaded = true;
    }
    function loadVideo(key) {
        if (!youtubeLoaded) {
          	return;
        }
        var args = $.extend({}, videoOptions, videos[key]);
        args.playerVars.controls = args.controls;
        videoPlayers[key] = new YT.Player(key, args);
        initEvents();
    }
    function privatePlayVideo(id, clicked) {
        var videoData = videos[id];
        var player = videoPlayers[id];
        var $slide = videos[id].$parentSlide;

        if (playOnClick) {
            // playOnClick means we are probably on mobile (no autoplay).
            // setAsPlaying will show the iframe, requiring another click
            // to play the video.
          	setAsPlaying(videoData);
        } else if (clicked || (autoplayCheckComplete && autoplayAvailable)) {
            // Play if autoplay is available or clicked to play
            $slide.removeClass(classes.loading);
            setAsPlaying(videoData);
            player.playVideo();
            return;
        }
        // Check for autoplay if not already done
        if (!autoplayCheckComplete) {
          	autoplayCheckFunction(player, $slide);
        }
    }
    function setAutoplaySupport(supported) {
        var supportClass = supported ? classes.supportsAutoplay : classes.supportsNoAutoplay;
        $(document.documentElement).addClass(supportClass);
        if (!supported) {
          	playOnClick = true;
        }
        autoplayCheckComplete = true;
    }
    function autoplayCheckFunction(player, $slide) {
      	// attempt to play video
      	player.playVideo();
      	autoplayTest(player)
        	.then(function() {
                setAutoplaySupport(true);
            })
            .fail(function() {
                // No autoplay available (or took too long to start playing).
                // Show fallback image. Stop video for safety.
                setAutoplaySupport(false);
                player.stopVideo();
            })
            .always(function() {
                autoplayCheckComplete = true;
                $slide.removeClass(classes.loading);
            });
    }
    function autoplayTest(player) {
        var deferred = $.Deferred();
        var wait;
        var timeout;
        wait = setInterval(function() {
          	if (player.getCurrentTime() <= 0) {
            	return;
          	}
          	autoplayAvailable = true;
          	clearInterval(wait);
          	clearTimeout(timeout);
          	deferred.resolve();
        }, 500);
        timeout = setTimeout(function() {
          	clearInterval(wait);
          	deferred.reject();
        }, 4000); // subjective. test up to 8 times over 4 seconds
        return deferred;
    }
    function playOnClickCheck() {
        // Bail early for a few instances:
        // - small screen
        // - device sniff mobile browser
        if (playOnClickChecked) {
          	return;
        }
        if ($(window).width() < 750) {
          	playOnClick = true;
        } else if (window.mobileCheck()) {
          	playOnClick = true;
        }
        if (playOnClick) {
          	// No need to also do the autoplay check
          	setAutoplaySupport(false);
        }
        playOnClickChecked = true;
    }
    // The API will call this function when each video player is ready
    function onPlayerReady(evt) {
        evt.target.setPlaybackQuality('hd1080');
        var videoData = getVideoOptions(evt);
        playOnClickCheck();
        // Prevent tabbing through YouTube player controls until visible
        $('#' + videoData.id).attr('tabindex', '-1');
        sizeBackgroundVideos();
        // Customize based on options from the video ID
        switch (videoData.type) {
          	case 'background-chrome':
          	case 'background':
            	evt.target.mute();
            	// Only play the video if it is in the active slide
            	if (videoData.$parentSlide.hasClass(classes.currentSlide)) {
              		privatePlayVideo(videoData.id);
            	}
            	break;
        }
        videoData.$parentSlide.addClass(classes.loaded);
    }
    function onPlayerChange(evt) {
        var videoData = getVideoOptions(evt);
        switch (evt.data) {
          	case 0: // ended
                setAsFinished(videoData);
                break;
          	case 1: // playing
                setAsPlaying(videoData);
                break;
          	case 2: // paused
                setAsPaused(videoData);
                break;
        }
    }
    function setAsFinished(videoData) {
        switch (videoData.type) {
            case 'background':
              	videoPlayers[videoData.id].seekTo(0);
              	break;
            case 'background-chrome':
              	videoPlayers[videoData.id].seekTo(0);
              	closeVideo(videoData.id);
              break;
            case 'chrome':
              	closeVideo(videoData.id);
              	break;
        }
    }
    function setAsPlaying(videoData) {
        var $slideshow = videoData.$parentSlideshowWrapper;
        var $slide = videoData.$parentSlide;
        $slide.removeClass(classes.loading);
        // Do not change element visibility if it is a background video
        if (videoData.status === 'background') {
          	return;
        }
        $('#' + videoData.id).attr('tabindex', '0');
            switch (videoData.type) {
                case 'chrome':
                case 'background-chrome':
                    $slideshow
                      .removeClass(classes.paused)
                      .addClass(classes.playing);
                    $slide
                      .removeClass(classes.paused)
                      .addClass(classes.playing);
                  	break;
        	}
        	// Update focus to the close button so we stay within the slide
        	$slide.find('.' + classes.closeVideoBtn).focus();
    }
  	function setAsPaused(videoData) {
    	var $slideshow = videoData.$parentSlideshowWrapper;
    	var $slide = videoData.$parentSlide;
    	if (videoData.type === 'background-chrome') {
      		closeVideo(videoData.id);
      		return;
    	}
    	// YT's events fire after our click event. This status flag ensures
    	// we don't interact with a closed or background video.
    	if (videoData.status !== 'closed' && videoData.type !== 'background') {
      		$slideshow.addClass(classes.paused);
      		$slide.addClass(classes.paused);
    	}
    	if (videoData.type === 'chrome' && videoData.status === 'closed') {
      		$slideshow.removeClass(classes.paused);
      		$slide.removeClass(classes.paused);
    	}
    	$slideshow.removeClass(classes.playing);
    	$slide.removeClass(classes.playing);
  	}
    function closeVideo(playerId) {
        var videoData = videos[playerId];
        var $slideshow = videoData.$parentSlideshowWrapper;
        var $slide = videoData.$parentSlide;
        var classesToRemove = [classes.pause, classes.playing].join(' ');
     	$('#' + videoData.id).attr('tabindex', '-1');
      	videoData.status = 'closed';
        switch (videoData.type) {
          	case 'background-chrome':
                videoPlayers[playerId].mute();
                setBackgroundVideo(playerId);
                break;
          	case 'chrome':
                videoPlayers[playerId].stopVideo();
                setAsPaused(videoData); // in case the video is already paused
                break;
        }
      	$slideshow.removeClass(classesToRemove);
      	$slide.removeClass(classesToRemove);
    }
    function getVideoOptions(evt) {
      	return videos[evt.target.h.id];
    }
    function startVideoOnClick(playerId) {
      	var videoData = videos[playerId];
      	// add loading class to slide
      	videoData.$parentSlide.addClass(classes.loading);
      	videoData.status = 'open';
        switch (videoData.type) {
            case 'background-chrome':
                unsetBackgroundVideo(playerId, videoData);
                videoPlayers[playerId].unMute();
                privatePlayVideo(playerId, true);
                break;
            case 'chrome':
              	privatePlayVideo(playerId, true);
              	break;
        }
        // esc to close video player
        $(document).on('keydown.videoPlayer', function(evt) {
            if (evt.keyCode === 27) {
              	closeVideo(playerId);
            }
        });
    }
    function sizeBackgroundVideos() {
        $('.' + classes.videoBackground).each(function(index, el) {
          	sizeBackgroundVideo($(el));
        });
    }
    function sizeBackgroundVideo($player) {
        var $slide = $player.closest('.' + classes.slide);
        // Ignore cloned slides
        if ($slide.hasClass(classes.slickClone)) {
          	return;
        }
        var slideWidth = $slide.width();
        var playerWidth = $player.width();
        var playerHeight = $player.height();
        // when screen aspect ratio differs from video, video must center and underlay one dimension
        if (slideWidth / videoOptions.ratio < playerHeight) {
            playerWidth = Math.ceil(playerHeight * videoOptions.ratio); // get new player width
            $player.width(playerWidth).height(playerHeight).css({
              	left: (slideWidth - playerWidth) / 2,
              	top: 0
            }); // player width is greater, offset left; reset top
        } else { // new video width < window width (gap to right)
            playerHeight = Math.ceil(slideWidth / videoOptions.ratio); // get new player height
            $player.width(slideWidth).height(playerHeight).css({
              	left: 0,
              	top: (playerHeight - playerHeight) / 2
            }); // player height is greater, offset top; reset left
        }
        $player
          	.prepareTransition()
          	.addClass(classes.loaded);
    }
    function unsetBackgroundVideo(playerId) {
        // Switch the background-chrome to a chrome-only player once played
        $('#' + playerId)
          	.removeAttr('style')
          	.removeClass(classes.videoBackground)
          	.addClass(classes.videoChrome);
        videos[playerId].$parentSlideshowWrapper
          	.removeClass(classes.slideBackgroundVideo)
          	.addClass(classes.playing);
        videos[playerId].$parentSlide
          	.removeClass(classes.slideBackgroundVideo)
          	.addClass(classes.playing);
        videos[playerId].status = 'open';
    }
    function setBackgroundVideo(playerId) {
        // Switch back to background-chrome when closed
        var $player = $('#' + playerId)
          	.addClass(classes.videoBackground)
          	.removeClass(classes.videoChrome);
        videos[playerId].$parentSlide
          	.addClass(classes.slideBackgroundVideo);
        videos[playerId].status = 'background';
        sizeBackgroundVideo($player);
    }
    function initEvents() {
        $(document).on('click.videoPlayer', '.' + classes.playVideoBtn, function(evt) {
          	var playerId = $(evt.currentTarget).data('controls');
          	startVideoOnClick(playerId);
        });
        $(document).on('click.videoPlayer', '.' + classes.closeVideoBtn, function(evt) {
          	var playerId = $(evt.currentTarget).data('controls');
          	closeVideo(playerId);
        });
        // Listen to resize to keep a background-size:cover-like layout
        $(window).on('resize.videoPlayer', $.debounce(250, function() {
          	if (youtubeLoaded) {
            	sizeBackgroundVideos();
          	}
        }));
    }
    function removeEvents() {
      	$(document).off('.videoPlayer');
      	$(window).off('.videoPlayer');
    }
    return {
        init: init,
        loadVideos: loadVideos,
        loadVideo: loadVideo,
        playVideo: customPlayVideo,
        pauseVideo: pauseVideo,
        removeEvents: removeEvents
    };
})();
wpbtheme.slideshows = {};
wpbtheme.SlideshowSection = (function() {
  	function SlideshowSection(container) {
    	var $container = this.$container = $(container);
    	var sectionId = $container.attr('data-section-id');
    	var slideshow = this.slideshow = '#wpbSlideshows' + sectionId;
    	$('.wpbssVideo', slideshow).each(function() {
      		var $el = $(this);
      		wpbtheme.SlideshowVideo.init($el);
      		wpbtheme.SlideshowVideo.loadVideo($el.attr('id'));
    	});
    	wpbtheme.slideshows[slideshow] = new wpbtheme.Slideshow(slideshow);
  	}
  	return SlideshowSection;
})();
wpbtheme.SlideshowSection.prototype = _.assignIn({}, wpbtheme.SlideshowSection.prototype, {
  	onUnload: function() {
    	delete wpbtheme.slideshows[this.slideshow];
  	},
    onBlockSelect: function(evt) {
        var $slideshow = $(this.slideshow);
        // Ignore the cloned version
        var $slide = $('.wpbssSlide' + evt.detail.blockId + ':not(.slick-cloned)');
        var slideIndex = $slide.data('slick-index');
        // Go to selected slide, pause autoplay
        $slideshow.slick('slickGoTo', slideIndex).slick('slickPause');
    },
    onBlockDeselect: function() {
      	// Resume autoplay
      	$(this.slideshow).slick('slickPlay');
    }
});
$(document).ready(function() {
	$(wpb.init);
	$('body').on('ajaxCart.afterCartLoad', function(evt, cart) {
        wpb.RightDrawer.open();
    });
	
  	var sections = new wpbtheme.Sections();
    sections.register('wpbSlideshowSection', wpbtheme.SlideshowSection);
	_canvasLeftNavigation();
	_canvasRightNavigation();
	_remove_wishlist();
	if($(".proFlyBlock.sticky").length > 0){
		_sticky_kit();
	}
	_sticky_menu();
	$('body').on('click', '.js-product-deal-thumbs', function(e) {
		e.preventDefault();
		var mainImage = $(this).parents('.js-product-deal').find('.imgFlyCart'),
			imageURL = $(this).data('image');
			mainImage.attr('src', imageURL);
	});
});
$(window).load(function() {
    $(wpb.productImage);
  	$(wpb.loadingSite);
	if (($(window).width()) >= 992 && $('#wpbNewsletterModal').length){
		_load_newsletter_popup();
	}
	_load_video_popup();
});

$( window ).resize(function() {
	wpb.productImage(); 
	_resize_sticky_kit();
});

function _canvasLeftNavigation(){
	//Navigation Left
	var $wpb_container_left = $('.wpb_container_left');
	$('.navigation-left').on( "click", function() {
		if($wpb_container_left.hasClass('active')){
			$wpb_container_left.removeClass('active');
			$('.wpb-container-popup').removeClass('active');
		} 
		else{
			$wpb_container_left.addClass('active');
			$('.wpb-container-popup').addClass('active');
		} 
		return false;
	}); 

	$('.wpb_close i',$wpb_container_left).on( "click", function() {
		$wpb_container_left.removeClass('active');
		$('.wpb-container-popup').removeClass('active');
		return false;
	});
	  
	$('.wpb-container-popup').on( "click", function() {
	   $wpb_container_left.removeClass('active');
	   $('.wpb-container-popup').removeClass('active');
		return false;
	});
}

function _canvasRightNavigation(){
	//Navigation Right
	var $wpb_container_right = $('.wpb_container_right');
	$('.navigation-right').on( "click", function() {
		if($wpb_container_right.hasClass('active')){
			$wpb_container_right.removeClass('active');
			$('.wpb-container-popup').removeClass('active');
		} 
		else{
			$wpb_container_right.addClass('active');
			$('.wpb-container-popup').addClass('active');
		} 
		return false;
	}); 

	$('.wpb_close i',$wpb_container_right).on( "click", function() {
		$wpb_container_right.removeClass('active');
		$('.wpb-container-popup').removeClass('active');
		return false;
	});
	  
	$('.wpb-container-popup').on( "click", function() {
	   $wpb_container_right.removeClass('active');
	   $('.wpb-container-popup').removeClass('active');
		return false;
	});
}

function _resize_sticky_kit(){
	if($(".proFlyBlock").length){
		var $element = $(".proFlyBlock");
		if($(".proFlyBlock.sticky").length > 0){
			_sticky_kit();
		}	
	}
}

function _sticky_kit(){
	var window_width = $( window ).width();
	$(".proBoxInfo").trigger("sticky_kit:detach");
	if (window_width < 991) {
		$(".proFlyBlock").removeClass("active");
	} else {
		if(($(".proBoxInfo").height()) <= ($(".proBoxInfo").height())){
			$(".proFlyBlock").addClass("active");
			$(".proBoxInfo").stick_in_parent();
		}else{
			$(".proFlyBlock").removeClass("active");
		}
	}		
}

function _load_newsletter_popup(){
	var dateCookie = new Date();
	var minutes = 100;
	var chkShowAgain = $('#chkNewsletterModal');
	dateCookie.setTime(dateCookie.getTime() + (minutes * 60 * 1000));
	if ($.cookie('newLetterModal') != 'closed') {
		$.fancybox.open({
			padding: 0,
			beforeLoad: function(){
				$('#wpbNewsletterModal').removeClass('hidden');
			},
			href: '#wpbNewsletterModal',
			helpers:  {
				overlay : true
			},
			afterClose : function(){
				$('#wpbNewsletterModal').addClass('hidden');
				if(chkShowAgain.is(':checked')){
					$.cookie('newLetterModal', 'closed', {expires:dateCookie, path:'/'});
				}
			}
		});
	}	
}

function _load_video_popup(){
	$(".wpb-video").click(function() {
		$.fancybox({
			'padding'		: 0,
			'href'			: $(this).attr("href").replace(new RegExp("watch\\?v=", "i"), 'v/'),
			'type'			: 'swf'
		});
		
		return false;
	});
}

function _remove_wishlist(){
	$('.remove','.wishlist-productlist').click(function() {
		var value = $(this).attr('data');
		$('.remove-value').val(value);
		$('.contact-form').submit();
	});
	$('.add').click(function() {
		var value = $(this).attr('data');
		$('.product-select').val(value);
		$('.add-variant').submit();
	});
}

function _load_owl_carousel(owlCarousel){
	var nav = owlCarousel.data("nav"),
		margin = (owlCarousel.data("margin") !== undefined) ? owlCarousel.data("margin") : 30,
		autoplay = owlCarousel.data("autoplay"),
		autospeed = owlCarousel.data("autospeed"),
		pagination = owlCarousel.data("pagination"),
		speed = owlCarousel.data("speed"),
		columnOne = owlCarousel.data("columnone"),
		columnTwo = owlCarousel.data("columntwo"),
		columnThree = owlCarousel.data("columnthree"),
		columnFour = owlCarousel.data("columnfour"),
		columnFive = owlCarousel.data("columnfive");
		if (!columnFive) {
		   columnFive = 1;
		}            

	var config = {
		items: columnOne,
		margin : margin,
		itemsDesktop: [1199, columnTwo],
		itemsDesktopSmall: [991, columnThree],
		itemsTablet: [767, columnFour],
		itemsTabletSmall: [479, 1],
		itemsMobile: [0, 1],
		responsiveClass:true,
		responsive:{
			0:{
				items:columnFive
			},
			479:{
				items:columnFour
			},
			767:{
				items:columnFour
			},
			991:{
				items:columnThree
			},
			1199:{
				items:columnOne
			}
		},
		nav: nav,
		dots: false,
		smartSpeed: speed,
		onInitialized: RemoveLoading
	};
	if(pagination) {
		config.dots = true;
	}
	if (autoplay){
		config.autoplay = autoplay;
		config.autoplaySpeed = autospeed;
	}
	owlCarousel.owlCarousel( config );
	function RemoveLoading(event){
		$(event.target).parents('.owlCarouselPlay').removeClass('proLoading');
	}
	function FirstLastActiveItem(event){
		event.find(".owl-item").removeClass("first");
		event.find(".owl-item.active").first().addClass("first");
		event.find(".owl-item").removeClass("last");
		event.find(".owl-item.active").last().addClass("last");
	}
}

function _sticky_menu(){
	if($(window).width() >= 1024){
			var CurrentScroll = 0;
			var bwp_width = $(window).width();
			$(window).scroll(function() {
				if(bwp_width < 992)
					return;
				var NextScroll = $(this).scrollTop();
				if ((NextScroll < CurrentScroll) && NextScroll > 200) {
					$('.headerFixed').addClass('active');
				} else if (NextScroll >= CurrentScroll ||  NextScroll <=200 ) {
					$('.headerFixed').removeClass('active');
				}

				CurrentScroll = NextScroll;  
			});
	}	
}

