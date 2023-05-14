import React from 'react';
import { Page } from '@inertiajs/inertia';
import { Employee, Order } from '@/types';
import { usePage } from '@inertiajs/inertia-react';
import ItemDetails from '@/Components/ItemDetails';
import PageWrapper from '@/Components/PageWrapper';

type EmployeeShowPage = Page<{
	employee: Employee;
	orders: Order[];
}>;

const Show: React.FC = () => {
	const {
		props: { employee },
	} = usePage<EmployeeShowPage>();

	return (
		<PageWrapper activeHeader="employees" title={`Employee: ${employee.name}`}>
			<ItemDetails item={employee} keys={{ id: 'ID', name: 'Name' }} />
		</PageWrapper>
	);
};

export default Show;
