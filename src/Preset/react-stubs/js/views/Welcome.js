import React from 'react';
import styled from 'styled-components';
import Layout from 'components/Layout';
import Image from 'components/Common/Image';
import hiFive from 'img/high-five.png';
import { rotate } from 'utils/styles/animation';

const AnimatedHand = styled(Image)`
  margin-left: 20px;
  animation: ${rotate(-45, 45)} 2s linear infinite;
`;

const Welcome = () => (
  <Layout>
    Welcome!!
    <AnimatedHand src={hiFive} width="20px" />
  </Layout>
);

export default Welcome;
