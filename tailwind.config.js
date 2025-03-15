import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',

    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './app/Livewire/**/*.php',  // Add this to include Livewire components
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'royal-blue': '#4169E1',
                'yellow-green': '#9ACD32',
                'crimson': '#FF0000',
                'azure': '#F0FFFF',
                'rebecca-purple': '#663399',
            },
        },
    },

    // Add this safelist to ensure dynamic color classes are included
    safelist: [
        'bg-blue-600',
        'bg-green-500',
        'bg-red-600',
        'bg-cyan-100',
        'bg-purple-700',
        'text-blue-600',
        'text-green-600',
        'text-red-600',
        'text-cyan-600',
        'text-purple-700',
        'hover:bg-blue-700',
        'hover:bg-green-600',
        'hover:bg-red-700',
        'hover:bg-cyan-200',
        'hover:bg-purple-800',
    ],

    plugins: [forms],
};
