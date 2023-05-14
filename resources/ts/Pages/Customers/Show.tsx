import React from 'react';
import { Page } from '@inertiajs/inertia';
import { Customer, Order } from '@/types';
import { usePage } from '@inertiajs/inertia-react';
import PageWrapper from '@/Components/PageWrapper';
import ItemDetails from '@/Components/ItemDetails';

type CustomerShowPage = Page<{
	customer: Customer;
	orders: Order[];
}>;

const Show: React.FC = () => {
	const {
		props: { customer },
	} = usePage<CustomerShowPage>();
	const { name, initials, lastname } = customer;

	return (
		<PageWrapper activeHeader="customers" title={`Customer: ${name}`}>
			<ItemDetails item={customer} keys={{ id: 'ID', initials: 'Initials', lastname: 'Lastname' }} />
		</PageWrapper>
	);
};

export default Show;
