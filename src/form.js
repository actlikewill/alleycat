function resetMessages()
{
  document.querySelectorAll('.field-msg').forEach((field) => {
    field.classList.remove('show');
  });
}

function validateEmail(email) {
  const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(String(email).toLowerCase());
}

document.addEventListener('DOMContentLoaded', (e) => {

  let testimonialForm = document.getElementById('alleycat-testimonial-form');
  
  testimonialForm.addEventListener('submit', (e) => {
    e.preventDefault();
    resetMessages();
    let data = {
      name: testimonialForm.querySelector('[name="name"]').value,
      email: testimonialForm.querySelector('[name="email"]').value,
      message: testimonialForm.querySelector('[name="message"]').value,
      nonce: testimonialForm.querySelector('[name="nonce"]').value,
    }
    if (!data.name) {
      testimonialForm.querySelector('[data-error="invalid-name"]').classList.add('show');
      return;
    }
    if (! validateEmail(data.email)) {
      testimonialForm.querySelector('[data-error="invalid-email"]').classList.add('show');
      return;
    }
    if (!data.message) {
      testimonialForm.querySelector('[data-error="invalid-message"]').classList.add('show');
      return;
    }
    
    let url = testimonialForm.dataset.url; 
    let params = new URLSearchParams(new FormData(testimonialForm));
    
    testimonialForm.querySelector('.js-form-submission').classList.add('show');

    fetch(url, {
      method: 'POST',
      body: params
    })
    .then( res => res.json())
    .catch(error => {
      resetMessages();
      testimonialForm.querySelector('.js-form-error').classList.add('show');
    })
    .then(response => {
      resetMessages();
     if( response === 0 || response.status === 'error') {
        testimonialForm.querySelector('.js-form-error').classList.add('show');
        return;
     }
      testimonialForm.querySelector('.js-form-success').classList.add('show');
      testimonialForm.reset();
    }); 
  });
});
