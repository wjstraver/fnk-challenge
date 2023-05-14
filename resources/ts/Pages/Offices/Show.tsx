import React from 'react';
import { Page } from '@inertiajs/inertia';
import { Office, Order } from '@/types';
import { usePage } from '@inertiajs/inertia-react';
import Heading from '@/Components/Heading';

type OfficeShowPage = Page<{
	office: Office;
	orders: Order[];
}>;

const Show: React.FC = () => {
	const {
		props: { office },
	} = usePage<OfficeShowPage>();

	return (
		<>
			<Heading active="offices" />
			<h1>{office.name}</h1>
		</>
	);
};

export default Show;
