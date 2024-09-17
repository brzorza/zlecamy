/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        // 9fef00 zielony
        // 00efe1 niebieski
        // 121112 161616 bg
        // #191c1f tło z revolu
        // red BF3131 B31312 D80032
        // #ff7e5f, #feb47b alternatywne pomaranczowo pastelowe

        // #111 - szary z gmaila
        // #151515
        // #2b2b2b

        primary: '#9fef00',
        primaryh: '#8ED600',
        secondary: '#00efe1',
        danger: '#B31312',
        dangerh: '#BF3131',
        background: '#121112',
        backgroundl: '#1e1e1e',
        backgroundll: '#333',
        overlay: '#121212c0',
      },
      boxShadow: {
        'light': '0px 0px 5px 0px #9fef0020',
      },
      minWidth: {
        '120': '550px',
      },
      maxWidth: {
        '120': '550px',
        '200': '960px',
        '240': '1200px'
      },
      minHeight: {
        '120': '550px',
        '150': '650px',
      },
      height: {
        '120': '550px',
        '150': '650px',
      },
      width: {
        '120': '550px',
        '135': '600px',
        '150': '650px',
      }
    },
  },
  plugins: [],
}