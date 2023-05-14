import React from 'react';
import { Page } from '@inertiajs/inertia';
import { Office } from '@/types';
import { InertiaLink, usePage } from '@inertiajs/inertia-react';
import Heading from '@/Components/Heading';

type OfficesIndexPage = Page<{
	offices: Office[];
}>;

const Index: React.FC = () => {
	const {
		props: { offices },
	} = usePage<OfficesIndexPage>();

	return (
		<>
			<Heading active="offices" />
			<ul>
				{offices.map((office) => (
					<li key={office.id}>
						<InertiaLink href={`/offices/${office.id}`}>{office.name}</InertiaLink>
					</li>
				))}
			</ul>
		</>
	);
};

export default Index;
