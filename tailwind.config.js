const svgToDataUri = require('mini-svg-data-uri')
const plugin = require('tailwindcss/plugin')
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
                    DEFAULT: colors.indigo['600'],
                    ...colors.indigo
                }
            }
        },
        screens: {
            'xs': '500px',
            ...defaultTheme.screens
        },
        boxShadow: {
			sm: '0 1px 2px 0 rgba(0, 0, 0, 0.05)',
			DEFAULT: '0 1px 4px 1px rgba(0, 0, 0, 0.08)',
			md: '0 1px 4px 1px rgb(0 0 0 / 8%)',
			lg: '0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)',
			xl: '0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)',
			'2xl': '0 25px 50px -12px rgba(0, 0, 0, 0.25)',
			inner: 'inset 0 2px 4px 0 rgba(0, 0, 0, 0.06)',
            // 'table-left': 'inset 50px 0px 15px -40px rgba(0, 0, 0, 0.06)',
            // 'table-inset': 'inset 50px 0px 15px -40px rgba(0, 0, 0, 0.06), inset -50px 0px 15px -40px rgba(0, 0, 0, 0.06)',
            // 'table-right': 'inset -50px 0px 15px -40px rgba(0, 0, 0, 0.06)',
			none: 'none',
		},
    },
    plugins: [
        plugin(function ({ addBase, theme }) {
            const selectLight   = svgToDataUri(`<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path stroke="${ theme('colors.gray.200') }" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 8l4 4 4-4"/></svg>`);

            //
            // SVG: <svg viewBox="0 0 16 16" fill="white" xmlns="http://www.w3.org/2000/svg"><path d="M12.207 4.793a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0l-2-2a1 1 0 011.414-1.414L6.5 9.086l4.293-4.293a1 1 0 011.414 0z"/></svg>
            const checkboxCheck = "data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3cpath d='M12.207 4.793a1 1 0 010 1.414l-5 5a1 1 0 01-1.414 0l-2-2a1 1 0 011.414-1.414L6.5 9.086l4.293-4.293a1 1 0 011.414 0z'/%3e%3c/svg%3e";

            //
            // SVG: <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 16"><path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h8"/></svg>
            const checkboxIndeterminate = "data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 16 16'%3e%3cpath stroke='white' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M4 8h8'/%3e%3c/svg%3e";

            //
            // SVG: <svg viewBox="0 0 16 16" fill="white" xmlns="http://www.w3.org/2000/svg"><circle cx="8" cy="8" r="3"/></svg>
            const radioCheck = "data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3ccircle cx='8' cy='8' r='3'/%3e%3c/svg%3e";

            addBase({
                'select': {
                    'background-image': `url("${ selectLight }")`
                },

                '[type=\'checkbox\']:checked': {
                    'background-image': `url("${ checkboxCheck }")`
                },

                '[type=\'radio\']:checked': {
                    'background-image': `url("${ radioCheck }")`
                },

                '[type=\'checkbox\']:indeterminate': {
                    'background-image': `url("${ checkboxIndeterminate }")`
                }
            })
        })
    ],
}
