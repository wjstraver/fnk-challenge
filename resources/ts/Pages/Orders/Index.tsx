import React from 'react';
import { Page } from '@inertiajs/inertia';
import { Order } from '@/types';
import { usePage } from '@inertiajs/inertia-react';
import PageWrapper from '@/Components/PageWrapper';
import { ordersToSortable } from '@/Helpers/ObjectHelpers';
import SortableTable from '@/Components/SortableTable';

type OrdersIndexPage = Page<{
	orders: Order[];
}>;

const Index: React.FC = () => {
	const {
		props: { orders },
	} = usePage<OrdersIndexPage>();

	const { items, keys } = ordersToSortable(orders);

	return (
		<PageWrapper activeHeader="orders" title="Orders">
			<SortableTable items={items} keys={keys} linkPrefix="/orders/" />
		</PageWrapper>
	);
};

export default Index;
