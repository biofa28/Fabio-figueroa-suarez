const galleryTrack = document.querySelector('.gallery-track');
const gallerySlides = Array.from(galleryTrack.children);
const nextBtn = document.querySelector('.next');
const prevBtn = document.querySelector('.prev');
let slideIndex = 0;

function updateGallery(position) {
  galleryTrack.style.transform = `translateX(-${position * 100}%)`;
}

nextBtn.addEventListener('click', () => {
  slideIndex = (slideIndex + 1) % gallerySlides.length;
  updateGallery(slideIndex);
});

prevBtn.addEventListener('click', () => {
  slideIndex = (slideIndex - 1 + gallerySlides.length) % gallerySlides.length;
  updateGallery(slideIndex);
});

// Auto-slide cada 3 segundos
setInterval(() => {
  slideIndex = (slideIndex + 1) % gallerySlides.length;
  updateGallery(slideIndex);
}, 3000);