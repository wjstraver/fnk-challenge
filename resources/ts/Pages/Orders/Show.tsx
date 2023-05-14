import React from 'react';
import { Page } from '@inertiajs/inertia';
import { Customer, Employee, Office, Order } from '@/types';
import { usePage } from '@inertiajs/inertia-react';
import ItemDetails from '@/Components/ItemDetails';
import PageWrapper from '@/Components/PageWrapper';

type OrderShowPage = Page<{
	order: Order;
	customer: Customer;
	employee: Employee;
	office: Office;
}>;

const Show: React.FC = () => {
	const {
		props: { order, office, employee, customer },
	} = usePage<OrderShowPage>();
	const { id, product, createdAt } = order;

	const item = {
		id,
		product,
		office: office?.name,
		employee: employee?.name,
		customer: customer?.name,
		createdAt,
	};

	const keys = {
		id: 'ID',
		product: 'Product',
		customer: 'Customer',
		office: 'Office',
		employee: 'Employee',
		createdAt: 'Created At',
	};

	return (
		<PageWrapper activeHeader="orders" title={`Order: ${order.id}`}>
			<ItemDetails item={item} keys={keys} />
		</PageWrapper>
	);
};

export default Show;
