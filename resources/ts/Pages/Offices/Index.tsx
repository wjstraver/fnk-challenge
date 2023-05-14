import React from 'react';
import { Page } from '@inertiajs/inertia';
import { Office } from '@/types';
import { InertiaLink, usePage } from '@inertiajs/inertia-react';
import PageWrapper from '@/Components/PageWrapper';

type OfficesIndexPage = Page<{
	offices: Office[];
}>;

const Index: React.FC = () => {
	const {
		props: { offices },
	} = usePage<OfficesIndexPage>();

	return (
		<PageWrapper activeHeader="offices" title="Offices">
			<ul>
				{offices.map((office) => (
					<li key={office.id}>
						<InertiaLink href={`/offices/${office.id}`}>{office.name}</InertiaLink>
					</li>
				))}
			</ul>
		</PageWrapper>
	);
};

export default Index;
