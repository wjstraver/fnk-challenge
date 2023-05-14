import React from 'react';
import { Page } from '@inertiajs/inertia';
import { Order } from '@/types';
import { usePage } from '@inertiajs/inertia-react';
import PageWrapper from '@/Components/PageWrapper';
import { ordersToSortable } from '@/Helpers/ObjectHelpers';
import SortableTable from '@/Components/SortableTable';

type ProductShowPage = Page<{
	product: string;
	orders: Order[];
}>;

const Show: React.FC = () => {
	const {
		props: { product, orders },
	} = usePage<ProductShowPage>();

	const { items, keys } = ordersToSortable(orders);

	return (
		<PageWrapper activeHeader="products" title={`Product: ${product}`}>
			<SortableTable items={items} keys={keys} title="Orders" linkPrefix="/orders/" />
		</PageWrapper>
	);
};

export default Show;
