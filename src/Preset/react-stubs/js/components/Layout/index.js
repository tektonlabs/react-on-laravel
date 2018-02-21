import React from 'react';
import PropTypes from 'prop-types';
import styled from 'styled-components';
import Header from 'components/Layout/Header';

const Body = styled.div`
  padding: 40px;
`;

const Layout = ({ children }) => (
  <div>
    <Header />
    <Body>
      {children}
    </Body>
  </div>
);

Layout.propTypes = {
  children: PropTypes.node.isRequired,
};

export default Layout;
