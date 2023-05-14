import { Customer, Employee, Office, Order, Product, SortableItem } from '@/types';

type ConvertableItem = {
	[key: string]: any;
	id?: number;
};

type ConvertableMapping = {
	[key: string]: string;
};

export function convertToSortableItems(items: ConvertableItem[], mapping: ConvertableMapping): SortableItem[] {
	return items.map((item) =>
		Object.entries(mapping).reduce(
			(result, [label, key]) => ({
				...result,
				[label]: item[key] ?? null,
			}),
			{ id: item.id },
		),
	);
}

export function customersToSortable(customers: Customer[]): { items: SortableItem[]; keys: string[] } {
	return {
		items: convertToSortableItems(customers, {
			Initials: 'initials',
			Lastname: 'lastname',
			Orders: 'orderCount',
		}),
		keys: ['id', 'Initials', 'Lastname', 'Orders'],
	};
}

export function employeesToSortable(employees: Employee[]): { items: SortableItem[]; keys: string[] } {
	return {
		items: convertToSortableItems(employees, {
			Name: 'name',
			'Sold Orders': 'orderCount',
		}),
		keys: ['id', 'Name', 'Sold Orders'],
	};
}

export function officesToSortable(offices: Office[]): { items: SortableItem[]; keys: string[] } {
	return {
		items: convertToSortableItems(offices, {
			Name: 'name',
			'Sold Orders': 'orderCount',
		}),
		keys: ['id', 'Name', 'Sold Orders'],
	};
}

export function ordersToSortable(orders: Order[]): { items: SortableItem[]; keys: string[] } {
	return {
		items: convertToSortableItems(orders, {
			Product: 'product',
			'Created At': 'createdAt',
		}),
		keys: ['id', 'Product', 'Created At'],
	};
}

export function productsToSortable(products: Product[]): { items: SortableItem[]; keys: string[] } {
	return {
		items: convertToSortableItems(products, {
			id: 'product',
			Product: 'product',
			'Sale Count': 'saleCount',
		}),
		keys: ['Product', 'Sale Count'],
	};
}
