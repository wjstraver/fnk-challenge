import React from 'react';
import { Page } from '@inertiajs/inertia';
import { Product } from '@/types';
import { InertiaLink, usePage } from '@inertiajs/inertia-react';
import Heading from '@/Components/Heading';

type ProductsIndexPage = Page<{
	products: Product[];
}>;

const Index: React.FC = () => {
	const {
		props: { products },
	} = usePage<ProductsIndexPage>();

	return (
		<>
			<Heading active="products" />
			<ul>
				{products.map((product) => (
					<li key={product.product}>
						<InertiaLink href={`/products/${product.product}`}>{product.product}</InertiaLink>
					</li>
				))}
			</ul>
		</>
	);
};

export default Index;
