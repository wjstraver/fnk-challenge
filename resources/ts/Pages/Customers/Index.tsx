import React from 'react';
import { Page } from '@inertiajs/inertia';
import { Customer } from '@/types';
import { usePage } from '@inertiajs/inertia-react';
import PageWrapper from '@/Components/PageWrapper';
import { customersToSortable } from '@/Helpers/ObjectHelpers';
import SortableTable from '@/Components/SortableTable';

type CustomersIndexPage = Page<{
	customers: Customer[];
}>;

const Index: React.FC = () => {
	const {
		props: { customers },
	} = usePage<CustomersIndexPage>();

	const { items, keys } = customersToSortable(customers);

	return (
		<PageWrapper activeHeader="customers" title="Customers">
			<SortableTable items={items} keys={keys} linkPrefix="/customers/" />
		</PageWrapper>
	);
};

export default Index;
