jQuery(document).ready(function($){

    $('#dangky-inline').click(function(){
        $('#dangnhapModal').modal('hide');
    });
    $('#dangnhap-inline').click(function(){
        $('#dangkyModal').modal('hide');
    })

    $("#1").click(function(){   
        $(".navbar-default .navbar-nav>li").removeClass("active");
        $(".navbar-default .navbar-nav>li").eq(0).addClass("active");
    })
    $("#2").click(function(){
        $(".navbar-default .navbar-nav>.active>a").removeClass("active");
        $(".navbar-default .navbar-nav>li").removeClass("active");
        $(".navbar-default .navbar-nav>li").eq(1).addClass("active");
    })
    $("#3").click(function(){   
        $(".navbar-default .navbar-nav>li").removeClass("active");
        $(".navbar-default .navbar-nav>li").eq(2).addClass("active");
    })
    $("#4").click(function(){   
        $(".navbar-default .navbar-nav>li").removeClass("active");
        $(".navbar-default .navbar-nav>li").eq(3).addClass("active");
    })
    $("#5").click(function(){   
        $(".navbar-default .navbar-nav>li").removeClass("active");
        $(".navbar-default .navbar-nav>li").eq(4).addClass("active");
    })
    $("#6").click(function(){   
        $(".navbar-default .navbar-nav>li").removeClass("active");
        $(".navbar-default .navbar-nav>li").eq(5).addClass("active");
    }) 
    // jQuery sticky Menu
    
	$(".mainmenu-area").sticky({topSpacing:0});
    
    
    $('.product-carousel').owlCarousel({
        loop:true,
        nav:true,
        margin:20,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
            },
            600:{
                items:3,
            },
            1000:{
                items:5,
            }
        }
    });  
    
    $('.related-products-carousel').owlCarousel({
        loop:true,
        nav:true,
        margin:20,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
            },
            600:{
                items:2,
            },
            1000:{
                items:2,
            },
            1200:{
                items:3,
            }
        }
    });  
    
    $('.brand-list').owlCarousel({
        loop:true,
        nav:true,
        margin:20,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
            },
            600:{
                items:3,
            },
            1000:{
                items:4,
            }
        }
    });    
    
    
    // Bootstrap Mobile Menu fix
    $(".navbar-nav li a").click(function(){
        $(".navbar-collapse").removeClass('in');
    });    
    
    // jQuery Scroll effect
    $('.navbar-nav li a, .scroll-to-up').bind('click', function(event) {
        var $anchor = $(this);
        var headerH = $('.header-area').outerHeight();
        $('html, body').stop().animate({
            scrollTop : $($anchor.attr('href')).offset().top - headerH + "px"
        }, 1200, 'easeInOutExpo');

        event.preventDefault();
    });    
    
    // Bootstrap ScrollPSY
    $('body').scrollspy({
        target: '.navbar-collapse',
        offset: 95
    });

    menuLeft = $('.pushmenu-left');
        nav_list = $('.bar-toggle');
        
        nav_list.click(function() {
            $(this).toggleClass('active');
            $('.pushmenu-push').toggleClass('pushmenu-push-toright');
            menuLeft.toggleClass('pushmenu-open');
        });
    
});

