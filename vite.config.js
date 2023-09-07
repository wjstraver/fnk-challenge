import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
	plugins: [
		laravel({
			input: ['resources/css/app.css', 'resources/ts/app.js'],
			refresh: true,
		}),
	],
	resolve: {
		alias: {
			'@': '/resources/ts',
		},
	},
});
