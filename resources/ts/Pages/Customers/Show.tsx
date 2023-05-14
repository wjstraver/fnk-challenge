import React from 'react';
import { Page } from '@inertiajs/inertia';
import { Customer, Order } from '@/types';
import { usePage } from '@inertiajs/inertia-react';
import Header from '@/Components/Header';

type CustomerShowPage = Page<{
	customer: Customer;
	orders: Order[];
}>;

const Show: React.FC = () => {
	const {
		props: { customer },
	} = usePage<CustomerShowPage>();

	return (
		<>
			<Header active="customers" />
			<h1>{customer.name}</h1>
		</>
	);
};

export default Show;
