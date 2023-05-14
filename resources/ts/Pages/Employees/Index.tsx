import React from 'react';
import { Page } from '@inertiajs/inertia';
import { Employee } from '@/types';
import { usePage } from '@inertiajs/inertia-react';
import PageWrapper from '@/Components/PageWrapper';
import { employeesToSortable } from '@/Helpers/ObjectHelpers';
import SortableTable from '@/Components/SortableTable';

type EmployeesIndexPage = Page<{
	employees: Employee[];
}>;

const Index: React.FC = () => {
	const {
		props: { employees },
	} = usePage<EmployeesIndexPage>();

	const { items, keys } = employeesToSortable(employees);

	return (
		<PageWrapper activeHeader="employees" title="Employees">
			<SortableTable items={items} keys={keys} linkPrefix="/employees/" />
		</PageWrapper>
	);
};

export default Index;
