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
      }
    }
  },
  plugins: [
    tailwindForms,
    tailwindAspectRatio,
    plugin(function ({addBase, addComponents, addVariant, addUtilities, theme}) {
      ['error', 'filled', 'processing'].forEach((variant) => {
        addVariant(variant, [`&[data-${variant}=true]`, `[data-${variant}=true] &`]);
      });

      addBase({
        'html,body': {
          backgroundColor: theme('backgroundColor.primary.950'),
          color: theme('colors.white'),
          '@apply antialiased': {},
          fontSize: '16px',
          '-webkit-tap-highlight-color': 'rgba(255, 255, 255, 0)',
          '@apply body-text': {}
        },
        'h1,h2,h3,h4,h5,h6': {
          '@apply heading-text': {}
        }
      });

      addComponents({
        '.heading-text': {
          fontFamily: theme('fontFamily.primary'),
          textTransform: 'uppercase',
          fontStyle: 'normal',
          fontWeight: theme('fontWeight.extrabold'),
          letterSpacing: theme('letterSpacing.widest')
        },
        '.body-text': {
          fontFamily: theme('fontFamily.secondary'),
          textTransform: 'none',
          fontStyle: 'italic',
          fontWeight: theme('fontWeight.bold'),
          letterSpacing: theme('letterSpacing.widest')
        }
      });

      addUtilities({
        '.blur-mask': {
          mask: 'linear-gradient(black, transparent)',
          backdropFilter: 'blur(20px)'
        },
        '.blur-mask-reverse': {
          mask: 'linear-gradient(transparent, black)',
          backdropFilter: 'blur(20px)'
        },
        '.text-shadow-default': {
          textShadow: '0 20px 20px #000'
        },
        '.text-shadow-none': {
          textShadow: 'none'
        },
        '.raised': {
          '@apply shadow-lg shadow-black/80': {}
        }
      });
    })
  ],
  safelist: [
    {
      pattern: /text-*/,
      variants: ['sm']
    }
  ]
};
