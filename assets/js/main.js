(()=>{"use strict";var e;document.querySelector(".swiper")&&((e=new Swiper(".swiper",{direction:"horizontal",loop:!0,slidesPerView:1,slidesPerGroup:1,spaceBetween:16,autoplay:{delay:5e3,disableOnInteraction:!1},breakpoints:{1024:{direction:"vertical",slidesPerView:2,slidesPerGroup:2,spaceBetween:32,autoHeight:!0}},navigation:{nextEl:".swiper-button-next",prevEl:".swiper-button-prev"},watchSlidesVisibility:!0,watchSlidesProgress:!0})).el.addEventListener("mouseenter",(function(){e.autoplay.stop()})),e.el.addEventListener("mouseleave",(function(){e.autoplay.start()})));var t,s,i=document.querySelector(".swiper-news-1"),o=document.querySelector(".swiper-news-2"),n=document.querySelector(".swiper-news-3");if(i){var r=new Swiper(".swiper-news-1",{direction:"horizontal",loop:!0,slidesPerView:1,slidesPerGroup:1,spaceBetween:16,simulateTouch:!0,autoplay:{delay:2e3,disableOnInteraction:!1},breakpoints:{1240:{slidesPerGroup:3,slidesPerView:3,spaceBetween:32},768:{slidesPerGroup:2,slidesPerView:2,spaceBetween:32}}});r.el.addEventListener("mouseenter",(function(){r.autoplay.stop()})),r.el.addEventListener("mouseleave",(function(){r.autoplay.start()}))}o&&((t=new Swiper(".swiper-news-2",{direction:"horizontal",loop:!0,slidesPerView:1,spaceBetween:16,simulateTouch:!0,autoplay:{delay:5e3,disableOnInteraction:!1},breakpoints:{1240:{slidesPerGroup:3,slidesPerView:3,spaceBetween:32},768:{slidesPerGroup:2,slidesPerView:2,spaceBetween:32}}})).el.addEventListener("mouseenter",(function(){t.autoplay.stop()})),t.el.addEventListener("mouseleave",(function(){t.autoplay.start()}))),n&&((s=new Swiper(".swiper-news-3",{direction:"horizontal",loop:!0,slidesPerView:1,spaceBetween:16,simulateTouch:!0,autoplay:{delay:2e3,disableOnInteraction:!1},breakpoints:{1240:{slidesPerGroup:3,slidesPerView:3,spaceBetween:32},768:{slidesPerGroup:2,slidesPerView:2,spaceBetween:32}},navigation:{nextEl:".swiper-news-3-button-next",prevEl:".swiper-news-3-button-prev"}})).el.addEventListener("mouseenter",(function(){s.autoplay.stop()})),s.el.addEventListener("mouseleave",(function(){s.autoplay.start()})));var l=document.querySelector(".header__toggle"),a=document.querySelector(".header-list"),c=document.querySelector(".header__wrapper-list");l.addEventListener("click",(function(){a.classList.toggle("active"),c.classList.toggle("active"),l.classList.toggle("active")}));for(var d=document.querySelectorAll(".header-list__svg"),u=function(e){d[e].addEventListener("click",(function(){var t=d[e].closest(".header-list__item");t.classList.toggle("active"),t.querySelector(".dropdown").classList.toggle("active")}))},p=0;p<d.length;p++)u(p);AOS.init();var w=document.querySelector(".button-scrolltop"),v=window.scrollY;function y(){var e=document.querySelector("header"),t=document.querySelector("footer"),s=document.querySelector("main"),i=e.offsetHeight,o=t.offsetHeight,n=window.innerHeight-i-o;s.style.minHeight="".concat(n,"px"),console.log(n,"totalHeight")}window.addEventListener("scroll",(function(){var e;(e=window.scrollY)>1e3&&v>e?w.classList.add("visible"):w.classList.remove("visible"),v=e})),w.addEventListener("click",(function(){window.scrollTo({top:0,behavior:"smooth"}),w.classList.remove("visible")})),document.addEventListener("DOMContentLoaded",y),window.addEventListener("resize",y)})();