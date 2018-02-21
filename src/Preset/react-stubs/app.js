/* eslint-disable */

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */
require('./bootstrap');

import React from 'react';
import { render } from 'react-dom';

const containers = document.querySelectorAll("[react-component]");

containers.forEach((container) => {
  const Component = require('./components/' + container.getAttribute('react-component')).default;

  render(<Component />, container);
});

/* eslint-enable */
