module.exports = {
  purge: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    // './resources/**/*.vue',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      colors: {
        gray: {
          750: '#2d3748',
          850: '#1a202c'
        },
      }
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
