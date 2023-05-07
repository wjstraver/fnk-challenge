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
				900: '#000000',
				800: '#262626',
				300: '#B2B2B2',
			},
			red: {
				DEFAULT: '#EA1B0A',
				100: '#F7E8DA',
				200: '#F6C1B0',
				900: '#b91508',
			},
			turquoise: {
				DEFAULT: '#1EA2B1',
				100: '#E1EDED',
				200: '#B0DADE',
			},
			yellow: '#E3E000',
			test: 'rgba(255, 20, 20, .5)',
			transparent: 'transparent',
		},
		extend: {
			fontFamily: {
				eon: ['eon', 'system-ui', 'sans-serif'],
			},
			screens: {
				mobile: { raw: '(max-aspect-ratio: 5/4)' },
				mini: { raw: '(max-height: 330px)' },
			},
		},
	},
	plugins: [],
};
