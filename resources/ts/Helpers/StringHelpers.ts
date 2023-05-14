export function mc(...classNames: any[]): string {
	return classNames
		.filter((className) => !!className)
		.join(' ')
		.trim();
}
