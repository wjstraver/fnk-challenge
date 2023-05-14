import React from 'react';
import { Page } from '@inertiajs/inertia';
import { Office, Order } from '@/types';
import { usePage } from '@inertiajs/inertia-react';
import ItemDetails from '@/Components/ItemDetails';
import PageWrapper from '@/Components/PageWrapper';
import { ordersToSortable } from '@/Helpers/ObjectHelpers';
import SortableTable from '@/Components/SortableTable';

type OfficeShowPage = Page<{
	office: Office;
	orders: Order[];
}>;

const Show: React.FC = () => {
	const {
		props: { office, orders },
	} = usePage<OfficeShowPage>();

	const { items, keys } = ordersToSortable(orders);

	return (
		<PageWrapper activeHeader="offices" title={`Office: ${office.name}`}>
			<ItemDetails item={office} keys={{ id: 'ID', name: 'Name' }} />
			<SortableTable items={items} keys={keys} title="Orders" linkPrefix="/orders/" />
		</PageWrapper>
	);
};

export default Show;
