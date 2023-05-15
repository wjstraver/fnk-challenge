import React from 'react';
import { Page } from '@inertiajs/inertia';
import { SortableItem } from '@/types';
import { usePage } from '@inertiajs/inertia-react';
import PageWrapper from '@/Components/PageWrapper';
import SortableTable from '@/Components/SortableTable';

type IndexPage = Page<{
	items: SortableItem[];
	title: string;
	page?: string;
}>;

const Index: React.FC = () => {
	const {
		props: { items, title, page },
	} = usePage<IndexPage>();

	return (
		<PageWrapper activeHeader={page} title={title}>
			<SortableTable items={items} />
		</PageWrapper>
	);
};

export default Index;
