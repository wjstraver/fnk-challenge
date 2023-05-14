import React from 'react';
import { Page } from '@inertiajs/inertia';
import { Employee } from '@/types';
import { InertiaLink, usePage } from '@inertiajs/inertia-react';

type EmployeesIndexPage = Page<{
	employees: Employee[];
}>;

const Index: React.FC = () => {
	const {
		props: { employees },
	} = usePage<EmployeesIndexPage>();

	return (
		<div>
			<ul>
				{employees.map((employee) => (
					<li key={employee.id}>
						<InertiaLink href={`/employees/${employee.id}`}>{employee.name}</InertiaLink>
					</li>
				))}
			</ul>
		</div>
	);
};

export default Index;
