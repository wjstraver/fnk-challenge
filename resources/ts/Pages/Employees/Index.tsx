import React from 'react';
import { Page } from '@inertiajs/inertia';
import { Employee } from '@/types';
import { InertiaLink, usePage } from '@inertiajs/inertia-react';
import Heading from '@/Components/Heading';

type EmployeesIndexPage = Page<{
	employees: Employee[];
}>;

const Index: React.FC = () => {
	const {
		props: { employees },
	} = usePage<EmployeesIndexPage>();

	return (
		<>
			<Heading active="employees" />
			<ul>
				{employees.map((employee) => (
					<li key={employee.id}>
						<InertiaLink href={`/employees/${employee.id}`}>{employee.name}</InertiaLink>
					</li>
				))}
			</ul>
		</>
	);
};

export default Index;
