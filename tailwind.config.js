module.exports = {
  theme: {
    extend: {}
  },
  variants: {
    appearance: ['responsive'],
    backgroundColors: ['responsive', 'hover', 'focus'],
    fill: [],
  },
  plugins: [
    require('tailwindcss-transforms'),
    require('tailwindcss-transitions'),
    require('tailwindcss-border-gradients'),
    require('tailwindcss-plugins/pagination'),
  ]
}
