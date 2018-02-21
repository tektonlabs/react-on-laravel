import { css } from 'styled-components';

const sizes = {
  giant: 1170,
  desktop: 992,
  tablet: 768,
  phone: 320,
};

export const media = Object.keys(sizes).reduce((accumulator, label) => {
  const emSize = sizes[label] / 16;

  return {
    ...accumulator,
    [label]: (...args) => css`
      @media (min-width: ${emSize}em) {
        ${css(...args)}
      }
    `,
  };
}, {});

export const maxMedia = Object.keys(sizes).reduce((accumulator, label) => {
  const emSize = (sizes[label] - 1) / 16;

  return {
    ...accumulator,
    [label]: (...args) => css`
      @media (max-width: ${emSize}em) {
        ${css(...args)}
      }
    `,
  };
}, {});


export default {
  media,
  maxMedia,
};
