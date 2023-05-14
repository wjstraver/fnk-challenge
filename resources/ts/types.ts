export type Customer = {
	id: number;
	name: string;
	initials: string;
	lastname: string;
	orderCount?: number;
	orders?: Order[];
};

export type Employee = {
	id: number;
	name: string;
	orderCount?: number;
	orders?: Order[];
};

export type Office = {
	id: number;
	name: string;
	orderCount?: number;
	orders?: Order[];
};

export type Order = {
	id: number;
	product: string;
	createdAt: string;
	customer?: Customer;
	employee?: Employee;
	office?: Office;
};

export type Product = {
	product: string;
	saleCount: number;
};
