import React from 'react';
import { Page } from '@inertiajs/inertia';
import { Order } from '@/types';
import { InertiaLink, usePage } from '@inertiajs/inertia-react';
import PageWrapper from '@/Components/PageWrapper';

type OrdersIndexPage = Page<{
	orders: Order[];
}>;

const Index: React.FC = () => {
	const {
		props: { orders },
	} = usePage<OrdersIndexPage>();

	return (
		<PageWrapper activeHeader="orders" title="Orders">
			<ul>
				{orders.map((order) => (
					<li key={order.id}>
						<InertiaLink href={`/orders/${order.id}`}>{order.product}</InertiaLink>
					</li>
				))}
			</ul>
		</PageWrapper>
	);
};

export default Index;
