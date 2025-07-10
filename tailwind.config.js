/** @type {import('tailwindcss').Config} */
module.exports ={
  presets:[
    require('./vendor/wireui/wireui/tailwind.config.js'),
  ],
  content: [
     "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",

    "./vendor/wireui/wireui/src/*.php",
    "./vendor/wireui/wireui/ts/**/*.ts",
    "./vendor/wireui/wireui/src/WireUi/**/*.php",
    "./vendor/wireui/wireui/src/Components/**/*.php",
  ],
  theme: {
    extend: {
       colors: {
        accent: 'rgb(var(--color-accent) / <alpha-value>)',
        'accent-foreground': 'rgb(var(--color-accent-foreground) / <alpha-value>)',
      },
      ringColor: {
        accent: 'rgb(var(--color-accent) / <alpha-value>)',
        'accent-foreground': 'rgb(var(--color-accent-foreground) / <alpha-value>)',
      },
      ringOffsetColor: {
        accent: 'rgb(var(--color-accent) / <alpha-value>)',
        'accent-foreground': 'rgb(var(--color-accent-foreground) / <alpha-value>)',
      },
    },
  },
  plugins: [],
}

