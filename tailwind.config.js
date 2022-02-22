const colors = require('tailwindcss/colors')
const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.ts'
    ],
    darkMode: 'media',
    theme: {
        extend: {
            colors: {
                primary: {
                    DEFAULT: colors.indigo['500'],
                    ...colors.indigo
                }
            }
        },
        screens: {
            'xs': '500px',
            ...defaultTheme.screens
        }
    }
}
