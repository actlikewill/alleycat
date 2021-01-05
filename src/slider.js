const sliderView = document.querySelector('.ac-slider--view > ul');
const sliderViewSlides = document.querySelectorAll('.ac-slider--view__slides');
const arrowLeft = document.querySelector('.ac-slider--arrows__left');
const arrowRight = document.querySelector('.ac-slider--arrows__right');
const sliderLength = sliderViewSlides.length;

arrowRight.addEventListener('click', () => {
  beforeSliding(1);
});
arrowLeft.addEventListener('click', () => {
  beforeSliding(0);
});

const slideMe = ( sliderViewItems, isActiveItem ) => {
  isActiveItem.classList.remove('is-active');
  sliderViewItems.classList.add('is-active');
  sliderView.setAttribute('style', 'transform:translateX(-'+ sliderViewItems.offsetLeft +'px)');
}
const beforeSliding = (i) => {
  let isActiveItem = document.querySelector('.ac-slider--view__slides.is-active');
  let currentItem = Array.from(sliderViewSlides).indexOf(isActiveItem) + i;
  let nextItem = currentItem + i;
  let sliderViewItems = document.querySelector('.ac-slider--view__slides:nth-child('+ nextItem +')');

  if( nextItem > sliderLength) {
    sliderViewItems = document.querySelector('.ac-slider--view__slides:nth-child(1)')
  }

  if(nextItem == 0) {
   sliderViewItems = document.querySelector('.ac-slider--view__slides:nth-child('+ sliderLength +')');
  }

  slideMe(sliderViewItems, isActiveItem);
}