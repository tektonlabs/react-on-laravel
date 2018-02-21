import React from 'react';
import styled from 'styled-components';
import Item from 'components/Layout/Header/Item';
import Link from 'components/Common/Link';
import colors, { colorLuminance } from 'utils/styles/color';
import { media } from 'utils/styles/media';

const Container = styled.div`
  align-items: center;
  background-color: ${colorLuminance(colors.grey, 0.5)};
  border-bottom: 1px solid ${colorLuminance(colors.grey, 0.2)};
  display: flex;
  justify-content: space-between;
`;

const Left = styled.div`
  align-items: center;  
  justify-content: space-between;
  display: flex;
  width: 100%;

  ${media.tablet`
    justify-content: flex-start;
  `}
`;

const Right = styled.div`
  align-items: center;  
  display: none;

  ${media.tablet`
    display: flex;
  `}
`;

const Header = () => (
  <Container>
    <Left>
      <Item noHover>Laravel</Item>
      <Link href="/">
        <Item>Home</Item>
      </Link>
    </Left>
    <Right>
      <Link href="/login">
        <Item>Login</Item>
      </Link>
      <Link href="/register">
        <Item>Register</Item>
      </Link>
    </Right>
  </Container>
);

export default Header;
