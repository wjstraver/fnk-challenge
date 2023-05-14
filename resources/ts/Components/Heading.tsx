import React from 'react';
import MaxWidthContainer from '@/Components/General/MaxWidthContainer';
import Fonky from '@/Components/General/Fonky';
import { InertiaLink } from '@inertiajs/inertia-react';

const HeadingLink: React.FC<{ href: string; label: string }> = ({ href, label }) => (
	<li className="font-bold uppercase hover:text-orange">
		<InertiaLink href={href}>{label}</InertiaLink>
	</li>
);

const Heading: React.FC = () => {
	return (
		<header className="w-full bg-white z-10 shadow-heading text-blue">
			<MaxWidthContainer>
				<nav className="py-6 flex">
					<InertiaLink href="/" className="relative">
						<Fonky className="w-[180px] max-w-full h-auto hover:text-orange" />
					</InertiaLink>
					<ul className="flex items-center flex-1 justify-end gap-6 w-full">
						<HeadingLink href="/customers" label="Customer" />
						<HeadingLink href="/employees" label="Employees" />
						<HeadingLink href="/offices" label="Offices" />
						<HeadingLink href="/orders" label="Orders" />
						<HeadingLink href="/products" label="Products" />
					</ul>
				</nav>
			</MaxWidthContainer>
		</header>
	);
};

export default Heading;
