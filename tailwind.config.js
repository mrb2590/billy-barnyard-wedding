import tailwindAspectRatio from '@tailwindcss/aspect-ratio';
import tailwindForms from '@tailwindcss/forms';
import colors from 'tailwindcss/colors';
import defaultTheme from 'tailwindcss/defaultTheme';
import plugin from 'tailwindcss/plugin';

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './resources/js/**/*.vue'
  ],
  theme: {
    extend: {
      colors: {
        primary: colors.slate,
        secondary: colors.sky,
        success: colors.green,
        danger: colors.red
      },
      fontFamily: {
        primary: ['Abhaya Libre', ...defaultTheme.fontFamily.serif],
        secondary: ['Cormorant', ...defaultTheme.fontFamily.serif]
      },
      screens: {
        xs: '480px'
      }
    }
  },
  plugins: [
    tailwindForms,
    tailwindAspectRatio,
    plugin(function ({addComponents, addVariant, theme}) {
      ['error', 'filled', 'processing'].forEach((variant) => {
        addVariant(variant, [`&[data-${variant}=true]`, `[data-${variant}=true] &`]);
      });
    })
  ]
};
