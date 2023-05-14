import React from 'react';
import { Page } from '@inertiajs/inertia';
import { Customer, Order } from '@/types';
import { usePage } from '@inertiajs/inertia-react';
import PageWrapper from '@/Components/PageWrapper';
import ItemDetails from '@/Components/ItemDetails';
import { ordersToSortable } from '@/Helpers/ObjectHelpers';
import SortableTable from '@/Components/SortableTable';

type CustomerShowPage = Page<{
	customer: Customer;
	orders: Order[];
}>;

const Show: React.FC = () => {
	const {
		props: { customer, orders },
	} = usePage<CustomerShowPage>();

	const { items, keys } = ordersToSortable(orders);

	return (
		<PageWrapper activeHeader="customers" title={`Customer: ${customer.name}`}>
			<ItemDetails item={customer} keys={{ id: 'ID', initials: 'Initials', lastname: 'Lastname' }} />
			<SortableTable items={items} keys={keys} title="Orders" linkPrefix="/orders" />
		</PageWrapper>
	);
};

export default Show;
