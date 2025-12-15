import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Plus Jakarta Sans', ...defaultTheme.fontFamily.sans],
            },
            animation: {
                'morph': 'morph 8s linear infinite',
                'fade-in-up': 'fadeInUp 0.6s ease-out forwards',
            },
            keyframes: {
                morph: {
                    '0%, 100%': { borderRadius: '40% 60% 70% 30% / 40% 50% 60% 50%' },
                    '34%': { borderRadius: '70% 30% 50% 50% / 30% 30% 70% 70%' },
                    '67%': { borderRadius: '100% 60% 60% 100% / 100% 100% 60% 60%' },
                },
                fadeInUp: {
                    'from': {
                        opacity: '0',
                        transform: 'translateY(20px)',
                    },
                    'to': {
                        opacity: '1',
                        transform: 'translateY(0)',
                    },
                },
            },
            colors: {
                'pillar': {
                    'indigo': '#6366f1',
                    'teal': '#14b8a6',
                    'amber': '#f59e0b',
                    'rose': '#f43f5e',
                },
            },
            boxShadow: {
                'glass': '0 8px 32px rgba(31, 38, 135, 0.37)',
                'glow': '0 0 20px rgba(99, 102, 241, 0.4)',
            },
        },
    },

    plugins: [forms],
};

