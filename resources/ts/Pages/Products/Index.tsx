import React from 'react';
import { Page } from '@inertiajs/inertia';
import { Product } from '@/types';
import { InertiaLink, usePage } from '@inertiajs/inertia-react';

type ProductsIndexPage = Page<{
	products: Product[];
}>;

const Index: React.FC = () => {
	const {
		props: { products },
	} = usePage<ProductsIndexPage>();

	return (
		<div>
			<ul>
				{products.map((product) => (
					<li key={product.product}>
						<InertiaLink href={`/products/${product.product}`}>{product.product}</InertiaLink>
					</li>
				))}
			</ul>
		</div>
	);
};

export default Index;
