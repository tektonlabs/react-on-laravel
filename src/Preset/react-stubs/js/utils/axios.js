/* eslint-disable no-undef, no-console */
import axios from 'axios';

if (typeof window !== 'undefined') {
  const token = document.head.querySelector('meta[name="csrf-token"]');

  axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
  axios.defaults.maxRedirects = 0;

  if (token) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
  } else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
  }
}

export default axios;

/* eslint-enable */
