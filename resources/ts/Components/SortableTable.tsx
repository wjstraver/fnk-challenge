import React, { useEffect, useMemo, useState } from 'react';
import { SortableItem } from '@/types';
import { InertiaLink } from '@inertiajs/inertia-react';
import { Inertia } from '@inertiajs/inertia';
import { mc } from '@/Helpers/StringHelpers';

type TableProps = {
	items: SortableItem[];
	title?: string;
};

const Chevron: React.FC<{ direction: 'asc' | 'desc'; active: boolean }> = ({ direction, active }) => (
	<svg className="ml-2 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" width="8" height="14" viewBox="0 0 8 14">
		<path
			className={mc((!active || direction === 'desc') && 'opacity-50')}
			fill="currentColor"
			d="M1.70710678 4.70710678c-.39052429.39052429-1.02368927.39052429-1.41421356 0-.3905243-.39052429-.3905243-1.02368927 0-1.41421356l3-3c.39052429-.3905243 1.02368927-.3905243 1.41421356 0l3 3c.39052429.39052429.39052429 1.02368927 0 1.41421356-.39052429.39052429-1.02368927.39052429-1.41421356 0L4 2.41421356 1.70710678 4.70710678z"
		></path>
		<path
			className={mc((!active || direction === 'asc') && 'opacity-50')}
			fill="currentColor"
			d="M6.29289322 9.29289322c.39052429-.39052429 1.02368927-.39052429 1.41421356 0 .39052429.39052429.39052429 1.02368928 0 1.41421358l-3 3c-.39052429.3905243-1.02368927.3905243-1.41421356 0l-3-3c-.3905243-.3905243-.3905243-1.02368929 0-1.41421358.3905243-.39052429 1.02368927-.39052429 1.41421356 0L4 11.5857864l2.29289322-2.29289318z"
		></path>
	</svg>
);

const SortableRow: React.FC<{ item: SortableItem; keys: string[] }> = ({ item, keys }) => {
	return (
		<tr
			className="hover:bg-blue-300 cursor-pointer border-y-2 border-blue-300"
			onClick={item.link ? () => Inertia.get(item.link) : null}
		>
			{keys.map((key) => (
				<td className="px-3 py-2 shadow-row" key={`${item.ID}-${key}`}>
					{item.link ? (
						<InertiaLink href={item.link}>{item[key] ?? '-'}</InertiaLink>
					) : (
						<span>{item[key] ?? '-'}</span>
					)}
				</td>
			))}
		</tr>
	);
};

const SortableTable: React.FC<TableProps> = ({ items, title = '' }) => {
	const [sortDirection, setSortDirection] = useState<'desc' | 'asc'>('desc');
	const [sortColumn, setSortColumn] = useState<string>(null);
	const [sortedItems, setSortedItems] = useState<SortableItem[]>([...items]);
	const keys = useMemo<string[]>(() => {
		if (!items.length) {
			return [];
		}

		return Object.keys(items[0]).filter((key) => key !== 'link');
	}, [items]);

	useEffect(() => {
		if (!sortColumn) {
			setSortedItems([...items]);
			return;
		}

		setSortedItems(
			[...items].sort((a, b) => {
				if (a[sortColumn] === b[sortColumn]) {
					return 0;
				}
				if (sortDirection === 'asc') {
					return a[sortColumn] < b[sortColumn] ? -1 : 1;
				}
				return a[sortColumn] > b[sortColumn] ? -1 : 1;
			}),
		);
	}, [sortDirection, sortColumn, items]);

	function onTableHeadClick(key: string) {
		if (sortColumn !== key) {
			setSortColumn(key);
			setSortDirection('asc');
			return;
		}
		setSortDirection((previous) => (previous === 'asc' ? 'desc' : 'asc'));
	}

	return (
		<section className="mt-8">
			<h2>{title}</h2>
			<table className="my-6 w-full min-w-96 shadow-table border-blue-300 border-2 rounded-md border-separate border-spacing-0">
				<thead className="text-white bg-orange">
					<tr>
						{keys.map((key) => (
							<th key={key}>
								<button
									onClick={() => onTableHeadClick(key)}
									className="flex items-center w-full uppercase py-2 px-3"
								>
									{key}
									<Chevron direction={sortDirection} active={key === sortColumn} />
								</button>
							</th>
						))}
					</tr>
				</thead>
				<tbody>
					{sortedItems.map((item) => (
						<SortableRow item={item} keys={keys} key={item.ID} />
					))}
				</tbody>
			</table>
		</section>
	);
};

export default SortableTable;
