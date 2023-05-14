import React from 'react';
import { Page } from '@inertiajs/inertia';
import { Customer } from '@/types';
import { InertiaLink, usePage } from '@inertiajs/inertia-react';
import PageWrapper from '@/Components/PageWrapper';

type CustomersIndexPage = Page<{
	customers: Customer[];
}>;

const Index: React.FC = () => {
	const {
		props: { customers },
	} = usePage<CustomersIndexPage>();

	return (
		<PageWrapper activeHeader="customers" title="Customers">
			<ul>
				{customers.map((customer) => (
					<li key={customer.id}>
						<InertiaLink href={`/customers/${customer.id}`}>{customer.name}</InertiaLink>
					</li>
				))}
			</ul>
		</PageWrapper>
	);
};

export default Index;
