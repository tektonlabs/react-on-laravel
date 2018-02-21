import styled from 'styled-components';
import colors, { colorLuminance } from 'utils/styles/color';

export default styled.div`
  color: ${colors.black};
  padding: 20px;

  ${props => !props.noHover && `&:hover {
    background-color: ${colorLuminance(colors.grey, 0.2)};
  }`}
`;
