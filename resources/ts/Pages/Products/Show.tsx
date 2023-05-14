import React from 'react';
import { Page } from '@inertiajs/inertia';
import { Product, Order } from '@/types';
import { usePage } from '@inertiajs/inertia-react';
import Header from '@/Components/Header';

type ProductShowPage = Page<{
	product: Product;
	orders: Order[];
}>;

const Show: React.FC = () => {
	const {
		props: { product },
	} = usePage<ProductShowPage>();

	return (
		<>
			<Header active="products" />
			<h1>{product.product}</h1>
		</>
	);
};

export default Show;
