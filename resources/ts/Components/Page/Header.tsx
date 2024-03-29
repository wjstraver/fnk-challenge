import React from 'react';
import MaxWidthContainer from '@/Components/Page/MaxWidthContainer';
import Fonky from '@/Components/Page/Fonky';
import { InertiaLink } from '@inertiajs/inertia-react';
import { mc } from '@/Helpers/StringHelpers';
import { routes } from '@/routes';

const HeadingLink: React.FC<{ href: string; label: string; active: boolean }> = ({ href, label, active }) => (
	<li className={mc('font-bold uppercase hover:text-orange', active && 'text-orange')}>
		<InertiaLink href={href}>{label}</InertiaLink>
	</li>
);

const Header: React.FC<{ active?: string }> = ({ active }) => {
	return (
		<header className="w-full bg-white z-10 shadow-heading text-blue sticky top-0">
			<MaxWidthContainer>
				<nav className="py-6 flex">
					<InertiaLink href="/" className="relative">
						<Fonky className="w-[180px] max-w-full h-auto hover:text-orange" />
					</InertiaLink>
					<ul className="flex items-center flex-1 justify-end gap-6 w-full">
						{Object.entries(routes).map(([key, { href, label }]) => (
							<HeadingLink key={key} href={href} label={label} active={key === active} />
						))}
					</ul>
				</nav>
			</MaxWidthContainer>
		</header>
	);
};

export default Header;
