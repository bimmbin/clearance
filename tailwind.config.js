/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
        fontFamily: {
            mont: "'Montserrat', sans-serif",
            pop: "'poppins', Poppins",
        },
      colors: {
        darkblue: '#05041B',
        grayish: '#d6d8f3',
        dirtywhite: '#f1f1f1',
        borderr: '#252440',
        blacky: '#000000',
        tableborderr: '#B5B5B5',
      }
    }
  },
  plugins: [],
}
