import React, { useState } from 'react';
import { usePage } from '@inertiajs/inertia-react';
import { Page } from '@inertiajs/inertia';

type IndexProps = {
	title: string;
};

const Index: React.FC = () => {
	const {
		props: { title },
	} = usePage<Page<IndexProps>>();
	const [test, setTest] = useState<boolean>(false);

	return (
		<div className="w-full">
			<h1 className="text-3xl font-bold mb-3">{title}</h1>
			<button className="p-4 bg-black-300 text-white" onClick={() => setTest((p) => !p)}>
				click me!
			</button>
			<p className={test ? 'text-red-900' : 'text-turquoise'}>
				Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
				dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
				ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
				fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
				deserunt mollit anim id est laborum.
			</p>
		</div>
	);
};

export default Index;
