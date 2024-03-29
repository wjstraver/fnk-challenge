import React from 'react';

type DetailProps = {
	item: {
		[key: string]: any;
	};
};

const Entry: React.FC<{ label: string; value?: string }> = ({ label, value = '-' }) => (
	<li className="mb-2 pb-2 border-b-white border-b flex">
		<span className="flex-shrink-0 flex-grow-1 basis-1/3">{label}:</span>
		<span className="break-words">{value}</span>
	</li>
);

const ItemDetails: React.FC<DetailProps> = ({ item }) => {
	return (
		<section className="mt-8 bg-black-900 text-white max-w-full w-96 p-6">
			<h2 className="text-white">Details</h2>
			<ul>
				{Object.entries(item)
					.filter(([key]) => key !== 'link')
					.map(([key, value]) => (
						<Entry label={key} key={key} value={value} />
					))}
			</ul>
		</section>
	);
};

export default ItemDetails;
