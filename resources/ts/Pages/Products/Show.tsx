import React from 'react';
import { Page } from '@inertiajs/inertia';
import { Order } from '@/types';
import { usePage } from '@inertiajs/inertia-react';
import PageWrapper from '@/Components/PageWrapper';

type ProductShowPage = Page<{
	product: string;
	orders: Order[];
}>;

const Show: React.FC = () => {
	const {
		props: { product },
	} = usePage<ProductShowPage>();
	return (
		<PageWrapper activeHeader="products" title={`Product: ${product}`}>
			<p>table of orders</p>
		</PageWrapper>
	);
};

export default Show;
