/** @type {import('tailwindcss').Config} */
module.exports = {
	content: ['./resources/**/*.ts', './resources/**/*.tsx', './resources/**/*.blade.php'],
	theme: {
		colors: {
			white: {
				DEFAULT: '#ffffff',
			},
			black: {
				DEFAULT: '#000000',
				900: '#2c2c2c',
			},
			blue: {
				DEFAULT: '#24a1da',
			},
			orange: {
				DEFAULT: '#da5d24',
			},
			transparent: 'transparent',
		},
		extend: {
			boxShadow: {
				heading: '0 0 10px rgba(0,0,0,.6)',
			},
		},
	},
	plugins: [],
};
