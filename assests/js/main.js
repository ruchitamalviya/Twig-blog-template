$(document).ready(function(){
    $('.carousel').slick({
      slidesToShow: 3,
      slidesToScroll: 1,
      autoplay:false,
      autoplaySpeed: 2000,
      dots:true,
      prevArrow: false,
      nextArrow: false,
      centerMode: true,
      responsive: [{
        breakpoint: 1024,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 1,
          // centerMode: true,
  
        }
  
      }, {
        breakpoint: 800,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
          dots: true,
          infinite: true,
  
        }
      },  {
        breakpoint: 576,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          dots: true,
          infinite: true,
          autoplay: true,
          autoplaySpeed: 2000,
        }
      }]
    });
  
    $.fn.equalHeights = function(){
        var max_height = 0;
        $(this).each(function(){
          max_height = Math.max($(this).height(), max_height);
        });
        $(this).each(function(){
          $(this).height(max_height);
        });
      };
  
      $(document).ready(function(){
          $('.equal_height').equalHeights();
      });

      $(document).on("click", 'body', function(e){
        if($(".search_input").hasClass('search_show') && !(e.target.name == "search") ){
          $(".search_input").removeClass("search_show");
          $(".go_to_osome_icon").removeClass("hide");
          $(".dropdown_main").removeClass("hide");
        }
      })
      
      $(".search_btn").click(function(e){
        setTimeout(() => {
          $(".search_input").toggleClass("search_show") 
          $(".go_to_osome_icon").toggleClass("hide");
          $(".dropdown_main").toggleClass("hide");
        }) 
          e.preventDefault();
    });
    
});

document.getElementById('menu-toggle')
.addEventListener('click', function(){
  document.body.classList.toggle('nav-open');
});
 