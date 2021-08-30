module.exports = {
  purge: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      colors: {
        gray: {
          750: '#2d3748',
          850: '#1a202c'
        },
      },
      spacing: {
        112: '28rem',
        120: '30rem',
        128: '32rem',
        136: '34rem',
      },
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
