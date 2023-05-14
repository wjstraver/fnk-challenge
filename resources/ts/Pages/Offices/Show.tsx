import React from 'react';
import { Page } from '@inertiajs/inertia';
import { Office, Order } from '@/types';
import { usePage } from '@inertiajs/inertia-react';

type OfficeShowPage = Page<{
	office: Office;
	orders: Order[];
}>;

const Show: React.FC = () => {
	const {
		props: { office },
	} = usePage<OfficeShowPage>();

	return (
		<div>
			<h1>{office.name}</h1>
		</div>
	);
};

export default Show;
