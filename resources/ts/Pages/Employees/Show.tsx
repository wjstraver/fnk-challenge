import React from 'react';
import { Page } from '@inertiajs/inertia';
import { Employee, Order } from '@/types';
import { usePage } from '@inertiajs/inertia-react';
import ItemDetails from '@/Components/ItemDetails';
import PageWrapper from '@/Components/PageWrapper';
import SortableTable from '@/Components/SortableTable';
import { ordersToSortable } from '@/Helpers/ObjectHelpers';

type EmployeeShowPage = Page<{
	employee: Employee;
	orders: Order[];
}>;

const Show: React.FC = () => {
	const {
		props: { employee, orders },
	} = usePage<EmployeeShowPage>();

	const { items, keys } = ordersToSortable(orders);

	return (
		<PageWrapper activeHeader="employees" title={`Employee: ${employee.name}`}>
			<ItemDetails item={employee} keys={{ id: 'ID', name: 'Name' }} />
			<SortableTable items={items} keys={keys} title="Orders" linkPrefix="/orders/" />
		</PageWrapper>
	);
};

export default Show;
