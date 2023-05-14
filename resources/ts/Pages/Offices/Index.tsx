import React from 'react';
import { Page } from '@inertiajs/inertia';
import { Office } from '@/types';
import { InertiaLink, usePage } from '@inertiajs/inertia-react';

type OfficesIndexPage = Page<{
	offices: Office[];
}>;

const Index: React.FC = () => {
	const {
		props: { offices },
	} = usePage<OfficesIndexPage>();

	return (
		<div>
			<ul>
				{offices.map((office) => (
					<li key={office.id}>
						<InertiaLink href={`/offices/${office.id}`}>{office.name}</InertiaLink>
					</li>
				))}
			</ul>
		</div>
	);
};

export default Index;
