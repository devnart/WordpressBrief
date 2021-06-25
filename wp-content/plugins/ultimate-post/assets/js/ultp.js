(function($) {
    'use strict';

    // *************************************
    // Flex Menu
    // *************************************
    $(document).ready(function(){
        $('ul.ultp-flex-menu').flexMenu();
    });


    setLazyImage();
    function setLazyImage(){
        $(".ultp-lazy[data-src]").each(function() {
            $(this).attr('src', $(this).data('src')).addClass('ultp-lazy-done').removeClass('ultp-lazy'); 
        });
    }
    // *************************************
    // Previous Next
    // *************************************
    $('.ultp-prev-action, .ultp-next-action').off().on('click', function(e){
        e.preventDefault();

        let parents = $(this).closest('.ultp-next-prev-wrap'),
            wrap    = parents.closest('.ultp-block-wrapper').find('.ultp-block-items-wrap'),
            paged   = parseInt(parents.data('pagenum')),
            pages   = parseInt(parents.data('pages'));
        
        if($(this).hasClass('ultp-prev-action')){
            if($(this).hasClass('ultp-disable')){
                return
            }else{
                paged--;
                parents.data('pagenum', paged);
                parents.find('.ultp-prev-action, .ultp-next-action').removeClass('ultp-disable')
                if(paged == 1){
                    $(this).addClass('ultp-disable');
                }
            }
        }
        if($(this).hasClass('ultp-next-action')){
            if($(this).hasClass('ultp-disable')){
                return
            }else{
                paged++;
                parents.data('pagenum', paged);
                parents.find('.ultp-prev-action, .ultp-next-action').removeClass('ultp-disable')
                if(paged == pages){
                    $(this).addClass('ultp-disable');
                }
            }
        }

        const post_ID = (parents.parents('.ultp-shortcode').length != 0) ? parents.parents('.ultp-shortcode').data('postid') : parents.data('postid');

		$.ajax({
			url: ultp_data_frontend.ajax,
            type: 'POST',
            data: {
                action: 'ultp_next_prev', 
                paged: paged ,
                blockId: parents.data('blockid'),
                postId: post_ID,
                blockName: parents.data('blockname'),
                builder: parents.data('builder'),
                wpnonce: ultp_data_frontend.security
            },
            beforeSend: function(){
                parents.closest('.ultp-block-wrapper').addClass('ultp-loading-active')
            },
            success: function(data) {
                wrap.html(data);
            },
            complete:function(){
                parents.closest('.ultp-block-wrapper').removeClass('ultp-loading-active');
                setLazyImage();
            },
            error: function(xhr) {
                console.log('Error occured.please try again' + xhr.statusText + xhr.responseText );
                parents.closest('.ultp-block-wrapper').removeClass('ultp-loading-active');
            },
        });
    });
       

    // *************************************
    // Loadmore Append
    // *************************************
    $('.ultp-loadmore-action').off().on('click', function(e){
        e.preventDefault();

        let that    = $(this),
            parents = that.closest('.ultp-block-wrapper'),
            paged   = parseInt(that.data('pagenum')),
            pages   = parseInt(that.data('pages'));
        
        if(that.hasClass('ultp-disable')){
            return
        }else{
            paged++;
            that.data('pagenum', paged);
            if(paged == pages){
                $(this).addClass('ultp-disable');
            }else{
                $(this).removeClass('ultp-disable');
            }
        }

        const post_ID = (that.parents('.ultp-shortcode').length != 0) ? that.parents('.ultp-shortcode').data('postid') : that.data('postid');

        $.ajax({
            url: ultp_data_frontend.ajax,
            type: 'POST',
            data: {
                action: 'ultp_next_prev', 
                paged: paged ,
                blockId: that.data('blockid'),
                postId: post_ID,
                blockName: that.data('blockname'),
                builder: that.data('builder'),
                wpnonce: ultp_data_frontend.security
            },
            beforeSend: function() {
                parents.addClass('ultp-loading-active');
            },
            success: function(data) {
                $(data).insertBefore( parents.find('.ultp-loadmore-insert-before') );
            },
            complete:function() {
                parents.removeClass('ultp-loading-active');
                setLazyImage();
            },
            error: function(xhr) {
                console.log('Error occured.please try again' + xhr.statusText + xhr.responseText );
                parents.removeClass('ultp-loading-active');
            },
        });
    });


    // *************************************
    // Filter
    // *************************************
    $(document).on('click', '.ultp-filter-wrap li a', function(e){
        e.preventDefault();

        if($(this).closest('li').hasClass('filter-item')){
            let that    = $(this),
                parents = that.closest('.ultp-filter-wrap'),
                wrap = that.closest('.ultp-block-wrapper');

                parents.find('a').removeClass('filter-active');
                that.addClass('filter-active');

            const post_ID = (parents.parents('.ultp-shortcode').length != 0) ? parents.parents('.ultp-shortcode').data('postid') : parents.data('postid');

            $.ajax({
                url: ultp_data_frontend.ajax,
                type: 'POST',
                data: {
                    action: 'ultp_filter', 
                    taxtype: parents.data('taxtype'),
                    taxonomy: that.data('taxonomy'),
                    blockId: parents.data('blockid'),
                    postId: post_ID,
                    blockName: parents.data('blockname'),
                    wpnonce: ultp_data_frontend.security
                },
                beforeSend: function() {
                    wrap.addClass('ultp-loading-active');
                },
                success: function(data) {
                    wrap.find('.ultp-block-items-wrap').html(data);
                },
                complete:function() {
                    wrap.removeClass('ultp-loading-active');
                    setLazyImage();
                },
                error: function(xhr) {
                    console.log('Error occured.please try again' + xhr.statusText + xhr.responseText );
                    wrap.removeClass('ultp-loading-active');
                },
            });
        }
    });


    // *************************************
    // Pagination Number
    // *************************************
    function showHide(parents, pageNum, pages) {
        if (pageNum == 1) {
            parents.find('.ultp-prev-page-numbers').hide()
            parents.find('.ultp-next-page-numbers').show()
        } else if (pageNum == pages){
            parents.find('.ultp-prev-page-numbers').show()
            parents.find('.ultp-next-page-numbers').hide()
        } else {
            parents.find('.ultp-prev-page-numbers').show()
            parents.find('.ultp-next-page-numbers').show()
        }


        if(pageNum > 2) {
            parents.find('.ultp-first-pages').show()
            parents.find('.ultp-first-dot').show()
        }else{
            parents.find('.ultp-first-pages').hide()
            parents.find('.ultp-first-dot').hide()
        }
        
        if(pages > pageNum + 1){
            parents.find('.ultp-last-pages').show()
            parents.find('.ultp-last-dot').show()
        }else{
            parents.find('.ultp-last-pages').hide()
            parents.find('.ultp-last-dot').hide()
        }
    }

    function serial(parents, pageNum, pages){
        let datas = pageNum <= 2 ? [1,2,3] : ( pages == pageNum ? [pages-2,pages-1, pages] : [pageNum-1,pageNum,pageNum+1] )
        let i = 0
        parents.find('.ultp-center-item').each(function() {
            if(pageNum == datas[i]){
                $(this).addClass('pagination-active')
            }
            $(this).find('a').blur();
            $(this).attr('data-current', datas[i]).find('a').text(datas[i])
            i++
        });
    }

    $('.ultp-pagination-ajax-action li').off().on('click', function(e){
        e.preventDefault();

        let that    = $(this),
            parents = that.closest('.ultp-pagination-ajax-action'),
            wrap = that.closest('.ultp-block-wrapper');

        let pageNum = 1;
        let pages = parents.attr('data-pages');
        
        if( that.attr('data-current') ){
            pageNum = Number(that.attr('data-current'))
            parents.attr('data-paged', pageNum).find('li').removeClass('pagination-active')
            serial(parents, pageNum, pages)
            showHide(parents, pageNum, pages)
        } else {
            if (that.hasClass('ultp-prev-page-numbers')) {
                pageNum = Number(parents.attr('data-paged')) - 1
                parents.attr('data-paged', pageNum).find('li').removeClass('pagination-active')
                parents.find('li[data-current="'+pageNum+'"]').addClass('pagination-active')
                serial(parents, pageNum, pages)
                showHide(parents, pageNum, pages)
            } else if (that.hasClass('ultp-next-page-numbers')) {
                pageNum = Number(parents.attr('data-paged')) + 1
                parents.attr('data-paged', pageNum).find('li').removeClass('pagination-active')
                parents.find('li[data-current="'+pageNum+'"]').addClass('pagination-active')
                serial(parents, pageNum, pages)
                showHide(parents, pageNum, pages)
            }
        }

        const post_ID = (parents.parents('.ultp-shortcode').length != 0) ? parents.parents('.ultp-shortcode').data('postid') : parents.data('postid');

        if(pageNum){
            $.ajax({
                url: ultp_data_frontend.ajax,
                type: 'POST',
                data: {
                    action: 'ultp_pagination', 
                    paged: pageNum,
                    blockId: parents.data('blockid'),
                    postId: post_ID,
                    blockName: parents.data('blockname'),
                    builder: parents.data('builder'),
                    wpnonce: ultp_data_frontend.security
                },
                beforeSend: function() {
                    wrap.addClass('ultp-loading-active');
                },
                success: function(data) {
                    wrap.find('.ultp-block-items-wrap').html(data);
                    if($(window).scrollTop() > wrap.offset().top){
                        $([document.documentElement, document.body]).animate({
                            scrollTop: wrap.offset().top - 50
                        }, 100);
                    }
                },
                complete:function() {
                    wrap.removeClass('ultp-loading-active');
                    setLazyImage();
                },
                error: function(xhr) {
                    console.log('Error occured.please try again' + xhr.statusText + xhr.responseText );
                    wrap.removeClass('ultp-loading-active');
                },
            });
        }
    });
    
    // *************************************
    // SlideShow
    // *************************************
    $('.wp-block-ultimate-post-post-slider-1').each(function () {
        const sectionId = '#' + $(this).attr('id');
        const selector = $(sectionId).find('.ultp-block-items-wrap');
        selector.not('.slick-initialized').slick({
            arrows: true,
            dots: selector.data('dots') ? true : false,
            infinite: true,
            fade: selector.data('fade') ? true : false,
            speed: 500,
            slidesToShow: selector.data('slidestoshow') || 1,
            slidesToScroll: 1,
            autoplay: selector.data('autoplay') ? true : false,
            autoplaySpeed: selector.data('slidespeed') || 3000,
            cssEase: "linear",
            prevArrow: selector.parent().find('.ultp-slick-prev').html(),
            nextArrow: selector.parent().find('.ultp-slick-next').html(),
        });
    });
        
})( jQuery );