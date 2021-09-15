module.exports = {
  purge: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      colors: {
        gray: {
          750: '#2d3748',
          850: '#1a202c',
          860: '#1f2937'
        },
        green: {
          550: '#66FF66',
          560: '#90db60',
        }
      },
      spacing: {
        112: '28rem',
        120: '30rem',
        128: '32rem',
        136: '34rem',
      },
      backgroundImage: {
        'hobby-pattern': "url('/images/wallpaper.png')",
      },
    },
    fontFamily: {
      'computer': ['Courier New']
    }
  },
  variants: {
    extend: {
      opacity: ['disabled'],
      cursor: ['disabled'],
      backgroundColor: ['disabled'],
    }
  },
  plugins: [require('@tailwindcss/forms')],
}