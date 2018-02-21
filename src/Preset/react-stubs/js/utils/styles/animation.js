import { keyframes } from 'styled-components';

export const translateY = delta => keyframes`
  0% {
    transform: translateY(0px);
  }

  50% {
    transform: translateY(${delta}px);
  }

  100% {
    transform: translateY(0px);
  }
`;

export const rotate = (start, end) => keyframes`
  0% {
    transform: rotate(${start}deg);
  }

  25% {
    transform: rotate(0deg);
  }

  50% {
    transform: rotate(${end}deg);
  }

  75% {
    transform: rotate(0deg);
  }

  100% {
    transform: rotate(${start}deg);
  }
`;

export default {
  translateY,
  rotate,
};
