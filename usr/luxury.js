const bookNowBtn = document.querySelector('.add-to-cart-btn');
const bookingForm = document.querySelector('.booking-form');

bookNowBtn.addEventListener('click', function() {
  bookingForm.classList.remove('hidden');
});
