module.exports = {
  purge: [
    './src/Helpers/**/*.php',
    './resources/views/**/*.php',
    './resources/views/**/*.js',
  ],
  darkMode: 'class',
  theme: {
    extend: {
      colors: {
        current: 'currentColor',
        ccblue: {
          DEFAULT: '#1A2238',
        },
        cclavendel: {
          DEFAULT: '#9DAAF2',
        },
        ccorange: {
          DEFAULT: '#FF6A3D',
        },
        ccyellow: {
          DEFAULT: '#F4DB7D',
        },
      }
    },
  },
}
