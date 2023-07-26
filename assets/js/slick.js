  $(document).ready(function(){
      $('.img-product').slick({
          infinite: true,
          arrows: false,
          autoplay: true, 
          autoplaySpeed: 1500,
          draggable: true,
      });
  });
$(document).ready(function(){
    $('.container-img').slick({
        infinite: true,
        arrows: false,
        autoplay: true, 
        autoplaySpeed: 3000,
        draggable: false,
    });
});
$(document).ready(function(){
    $('.content-bottom-img').slick({
        infinite: true,
        arrows: false,
        autoplay: true, 
        autoplaySpeed: 2000,
        draggable: true,
    });
});
