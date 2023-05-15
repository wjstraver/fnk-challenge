import React from 'react';
import { usePage } from '@inertiajs/inertia-react';
import PageWrapper from '@/Components/PageWrapper';
import ItemDetails from '@/Components/ItemDetails';
import SortableTable from '@/Components/SortableTable';
import { Page } from '@inertiajs/inertia';
import { SortableItem } from '@/types';

type ShowPage = Page<{
	item: SortableItem;
	orders?: SortableItem[];
	title: string;
	page: string;
}>;

const Show: React.FC = () => {
	const {
		props: { item, orders, title, page },
	} = usePage<ShowPage>();

	return (
		<PageWrapper activeHeader={page} title={title}>
			<ItemDetails item={item} />
			{orders?.length && <SortableTable items={orders} title="Orders" />}
		</PageWrapper>
	);
};

export default Show;
