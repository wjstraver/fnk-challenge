import React from 'react';
import { Page } from '@inertiajs/inertia';
import { Office } from '@/types';
import { usePage } from '@inertiajs/inertia-react';
import PageWrapper from '@/Components/PageWrapper';
import { officesToSortable } from '@/Helpers/ObjectHelpers';
import SortableTable from '@/Components/SortableTable';

type OfficesIndexPage = Page<{
	offices: Office[];
}>;

const Index: React.FC = () => {
	const {
		props: { offices },
	} = usePage<OfficesIndexPage>();

	const { items, keys } = officesToSortable(offices);

	return (
		<PageWrapper activeHeader="offices" title="Offices">
			<SortableTable items={items} keys={keys} linkPrefix="/offices/" />
		</PageWrapper>
	);
};

export default Index;
