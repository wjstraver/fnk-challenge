import React from 'react';
import { Page } from '@inertiajs/inertia';
import { Office, Order } from '@/types';
import { usePage } from '@inertiajs/inertia-react';
import ItemDetails from '@/Components/ItemDetails';
import PageWrapper from '@/Components/PageWrapper';

type OfficeShowPage = Page<{
	office: Office;
	orders: Order[];
}>;

const Show: React.FC = () => {
	const {
		props: { office },
	} = usePage<OfficeShowPage>();

	return (
		<PageWrapper activeHeader="offices" title={`Office: ${office.name}`}>
			<ItemDetails item={office} keys={{ id: 'ID', name: 'Name' }} />
		</PageWrapper>
	);
};

export default Show;
