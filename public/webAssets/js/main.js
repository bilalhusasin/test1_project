(function ($) {
    "use strict";


    jQuery(document).ready(function ($) {
        // product slider active
        $('.product-slider-wrap').owlCarousel({ 
            loop:true,
            margin:15,
            responsiveClass:true,
            nav:true,
            dots: false,
            navText: ['<i class="fa-regular fa-chevron-left"></i>', '<i class="fa-regular fa-chevron-right"></i>'],
            smartSpeed: 1000,
            autoplay: false,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            items: 4
        });

        // product slider active
        $('.essunce-slider-wrap').owlCarousel({
            loop:true,
            margin:15,
            responsiveClass:true,
            nav:true,
            dots: false,
            navText: ['<i class="fa-sharp fa-regular fa-chevron-left"></i>', '<i class="fas-sharp fa-regular fa-chevron-right"></i>'],
            smartSpeed: 1000,
            autoplay: false,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            items: 1
        });
         // product slider active
         $('.tarkett-slider-wrap').owlCarousel({
            loop:true,
            margin:10,
            responsiveClass:true,
            nav:true,
            dots: false,
            navText: ['<i class="fa-sharp fa-regular fa-chevron-left"></i>', '<i class="fas-sharp fa-regular fa-chevron-right"></i>'],
            smartSpeed: 1000,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            items: 2,
            responsive:{
                576:{
                    items:3,
                },
                768:{
                    items:4,
                },
                992:{
                    items:3,
                },
                1200:{
                    items:2,
                },
                1400:{
                    items:3,
                }
            }
        });

        // category slider active
        $('.category-slider').owlCarousel({
            loop:true,
            margin:15,
            responsiveClass:true,
            nav:true,
            dots: false,
            navText: ['<i class="fa-regular fa-chevron-left"></i>', '<i class="fa-regular fa-chevron-right"></i>'],
            smartSpeed: 1000,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            items:1,
        });
         // category slider active
         $('.category-slider-2').owlCarousel({
            loop:false,
            margin:15,
            responsiveClass:true,
            nav:true,
            dots: false,
            navText: ['<i class="fa-regular fa-chevron-left"></i>', '<i class="fa-regular fa-chevron-right"></i>'],
            smartSpeed: 1000,
            autoplay: false,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            items:3,
            responsive:{
                576:{
                    items:4,
                },
                768:{
                    items:5,
                },
            }
        });

        // news slider active
        $('.news-slider').owlCarousel({
            loop:false,
            margin:30,
            responsiveClass:true,
            nav:true,
            dots: false,
            navText: ['<i class="fa-regular fa-chevron-left"></i>', '<i class="fa-regular fa-chevron-right"></i>'],
            smartSpeed: 1000,
            autoplay: false,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            responsive:{
                0:{
                    items:1,
                    nav:true
                },
                768:{
                    items:2,
                    margin:20,
                },
                1200:{
                    items:3,
                    margin:30,
                }
            }
        });

        // var swiper = new Swiper(".slider-nav", {
        //     loop: true,
        //     spaceBetween: 15,
        //     slidesPerView: 4,
        //     freeMode: true,
        //     watchSlidesProgress: true,
        // });
        // var swiper2 = new Swiper(".detail-img-slider", {
        //     loop: true,
        //     spaceBetween: 10,
        //     thumbs: {
        //       swiper: swiper,
        //     },
        // });


    }); //---document-ready-----

}(jQuery));


// price range slider
const rangeInput = document.querySelectorAll(".range-input input"),
  priceInput = document.querySelectorAll(".price-input input"),
  range = document.querySelector(".slider .progress");
let priceGap = 10;

priceInput.forEach((input) => {
  input.addEventListener("input", (e) => {
    let minPrice = parseInt(priceInput[0].value),
      maxPrice = parseInt(priceInput[1].value);

    if (maxPrice - minPrice >= priceGap && maxPrice <= rangeInput[1].max) {
      if (e.target.className === "input-min") {
        rangeInput[0].value = minPrice;
        range.style.left = (minPrice / rangeInput[0].max) * 100 + "%";
      } else {
        rangeInput[1].value = maxPrice;
        range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
      }
    }
  });
});

rangeInput.forEach((input) => {
  input.addEventListener("input", (e) => {
    let minVal = parseInt(rangeInput[0].value),
      maxVal = parseInt(rangeInput[1].value);

    if (maxVal - minVal < priceGap) {
      if (e.target.className === "range-min") {
        rangeInput[0].value = maxVal - priceGap;
      } else {
        rangeInput[1].value = minVal + priceGap;
      }
    } else {
      priceInput[0].value = minVal;
      priceInput[1].value = maxVal;
      range.style.left = (minVal / rangeInput[0].max) * 100 + "%";
      range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
    }
  });
});




   
