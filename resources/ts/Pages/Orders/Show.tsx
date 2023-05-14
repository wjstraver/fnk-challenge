import React from 'react';
import { Page } from '@inertiajs/inertia';
import { Customer, Employee, Office, Order } from '@/types';
import { usePage } from '@inertiajs/inertia-react';

type OrderShowPage = Page<{
	order: Order;
	customer: Customer;
	employee: Employee;
	office: Office;
}>;

const Show: React.FC = () => {
	const {
		props: { order },
	} = usePage<OrderShowPage>();

	return (
		<div>
			<h1>{order.product}</h1>
		</div>
	);
};

export default Show;
