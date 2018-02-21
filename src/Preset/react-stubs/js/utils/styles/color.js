export const colorLuminance = (rawHex, lum = 0) => {
  const clearHex = String(rawHex).replace(/[^0-9a-f]/gi, '').split('');
  const hex = clearHex.length < 6
    ? clearHex.reduce((acm, channel) => [...acm, channel, channel], [])
    : clearHex;

  const channels = [[hex[0], hex[1]], [hex[2], hex[3]], [hex[4], hex[5]]];

  return channels.reduce((rgb, hexChannel) => {
    const channel = parseInt(hexChannel.join(''), 16);
    const c = Math.round(Math.min(Math.max(0, channel + (channel * lum)), 255)).toString(16);

    return `${rgb}${`00${c}`.substr(c.length)}`;
  }, '#');
};

export default {
  black: '#000000',
  grey: '#9e9e9e',
  white: '#ffffff',
  colorLuminance,
};
