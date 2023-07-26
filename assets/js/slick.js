  $(document).ready(function(){
      $('.img_product').slick({
          infinite: true,
          arrows: false,
          autoplay: true, 
          autoplaySpeed: 1500,
          draggable: true,
      });
  });
$(document).ready(function(){
    $('.container__img').slick({
        infinite: true,
        arrows: false,
        autoplay: true, 
        autoplaySpeed: 3000,
        draggable: false,
    });
});
$(document).ready(function(){
    $('.content__bottom--img').slick({
        infinite: true,
        arrows: false,
        autoplay: true, 
        autoplaySpeed: 2000,
        draggable: true,
    });
});
