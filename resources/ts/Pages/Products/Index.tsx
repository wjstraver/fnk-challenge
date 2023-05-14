import React from 'react';
import { Page } from '@inertiajs/inertia';
import { Product } from '@/types';
import { usePage } from '@inertiajs/inertia-react';
import PageWrapper from '@/Components/PageWrapper';
import { productsToSortable } from '@/Helpers/ObjectHelpers';
import SortableTable from '@/Components/SortableTable';

type ProductsIndexPage = Page<{
	products: Product[];
}>;

const Index: React.FC = () => {
	const {
		props: { products },
	} = usePage<ProductsIndexPage>();

	const { items, keys } = productsToSortable(products);

	return (
		<PageWrapper activeHeader="products" title="Products">
			<SortableTable items={items} keys={keys} linkPrefix="/products/" />
		</PageWrapper>
	);
};

export default Index;
